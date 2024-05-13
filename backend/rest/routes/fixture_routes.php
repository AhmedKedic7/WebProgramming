<?php

require_once __DIR__ . "/../services/FixtureService.class.php";

Flight::set("fixture_service", new FixtureService);

Flight::group("/fixtures",function(){
    /**
 * @OA\Get(
 *      path="/fixtures/all",
 *      tags={"fixtures"},
 *      summary="Get all fixtures",
 *      @OA\Response(
 *           response=200,
 *           description="An array of all fixtures",
 *           
 *      )
 *       
 * )
 */
Flight::route("GET /all", function() {
    $fixture_service = new FixtureService();
    $data = $fixture_service->get_all_fixtures();
    Flight::json($data);
});
/**
 * @OA\Post(
 *      path="/fixtures/add",
 *      tags={"fixtures"},
 *      summary="Add a new fixture",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"home_team_fixture_id", "away_team_fixture_id"},
 *              @OA\Property(property="home_team_fixture_id", type="integer", example="10003"),
 *              @OA\Property(property="away_team_fixture_id", type="integer", example="10002"),
 *              @OA\Property(property="matchDate", type="string", example="2024-05-14"),
 *              @OA\Property(property="matchWeek", type="integer", example="5"),
 *              @OA\Property(property="matchTime", type="string", example="15:00"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Fixture added successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="You have successfully added the fixture"),
 *              
 *          ),
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad request",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Home Team Name is required"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal server error",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Internal Server Error"),
 *          ),
 *      ),
 * )
 */
Flight::route("POST /add", function() {
    $payload = Flight::request()->data->getData();

    if (empty($payload['home_team_fixture_id']) || empty($payload['away_team_fixture_id'])) {
        header('HTTP/1.1 400 Bad Request');
        die(Flight::json(['error' => 'Home Team Name is required']));
    }

    try {
        $fixtureService = new FixtureService();

        $fixture_data = [
            ':home_team_fixture_id' => $payload['home_team_fixture_id'],
            ':away_team_fixture_id' => $payload['away_team_fixture_id'],
            ':matchDate' => $payload['matchDate'] ?? null,
            ':matchWeek' => $payload['matchWeek'] ?? null,
            ':matchTime' => $payload['matchTime'] ?? null
        ];

        $fixture = $fixtureService->add_fixture($fixture_data);

        Flight::json([
            "message" => "You have successfully added the fixture",
            "data" => $fixture
        ]);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        Flight::json(['error' => $e->getMessage()]);
    }
});
 /**
     * @OA\Delete(
     *      path="/fixtures/delete/{fixture_id}",
     *      tags={"fixtures"},
     *      summary="Delete a fixture",
     *      @OA\Parameter(
     *          name="fixture_id",
     *          in="path",
     *          required=true,
     *          description="ID of the fixture to delete",
     *          @OA\Schema(type="integer",example="110010")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Fixture deleted successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="You have successfully deleted the fixture")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Invalid fixture ID",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid fixture id")
     *          )
     *      )
     * )
     */
    Flight::route("DELETE /delete/@fixture_id", function($fixture_id) {
        if ($fixture_id == NULL || $fixture_id == "") {
            header("HTTP/1.1 400 Bad Request");
            die(json_encode(["error" => "Invalid fixture id"]));
        }
    
        try {
            $fixture_service = new FixtureService();
            $fixture_service->delete_fixture($fixture_id);
            echo json_encode(["message" => "You have successfully deleted a fixture"]);
        } catch (Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(["error" => $e->getMessage()]);
        }
    });
    

});