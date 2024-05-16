<?php

require_once __DIR__ . "/../services/ResultService.class.php";

Flight::set("result_service", new ResultService);

Flight::group("/results",function(){
    /**
 * @OA\Get(
 *      path="/results/all",
 *      tags={"results"},
 *      summary="Get all results",
 *      @OA\Response(
 *           response=200,
 *           description="An array of all results",
 *           @OA\JsonContent(type="array", @OA\Items(type="object"))
 *      )
 * )
 */
    Flight::route("GET /all", function() {
        
        $data = Flight::get("result_service")->get_all_results();
        Flight::json($data);
    });
    /**
 * @OA\Delete(
 *      path="/results/delete/{result_id}",
 *      tags={"results"},
 *      summary="Delete a result",
 *      security={
 *          {"ApiKey": {}} 
 *          },
 *      @OA\Parameter(
 *          name="result_id",
 *          in="path",
 *          required=true,
 *          
 *          description="ID of the result to delete",
 *          @OA\Schema(type="integer",example="100018")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Result deleted successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="You have successfully deleted a result")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Invalid result ID",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Invalid result id")
 *          )
 *      )
 * )
 */
Flight::route("DELETE /delete/@result_id", function($result_id) {
    if ($result_id == NULL || $result_id == "") {
        header("HTTP/1.1 400 Bad Request");
        die(jFlight::json(["error" => "Invalid result id"]));
    }

    $result_service = new ResultService();
    $result_service->delete_result($result_id);

    Flight::json(["message" => "You have successfully deleted a result"]);
});
/**
 * @OA\Post(
 *      path="/results/add",
 *      tags={"results"},
 *      summary="Add a new result",
 *      security={
 *          {"ApiKey": {}} 
 *          },
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"home_team_id", "away_team_id"},
 *              @OA\Property(property="home_team_id", type="integer", example="10003"),
 *              @OA\Property(property="away_team_id", type="integer", example="10004"),
 *              @OA\Property(property="home_team_score", type="integer", example="55"),
 *              @OA\Property(property="away_team_score", type="integer", example="61"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Result added successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="You have successfully added the result"),
 *              @OA\Property(property="data", type="object", ref="#/components/schemas/Result"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad request",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Team Name is required"),
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

    if (empty($payload['home_team_id']) || empty($payload['away_team_id'])) {
        header('HTTP/1.1 400 Bad Request');
        die(Flight::json(['error' => 'Team Name is required']));
    }

    try {
        $resultService = new ResultService();

        $result_data = [
            ':home_team_id' => $payload['home_team_id'],
            ':away_team_id' => $payload['away_team_id'],
            ':home_team_score' => $payload['home_team_score'] ?? null,
            ':away_team_score' => $payload['away_team_score'] ?? null,
        ];

        $result = $resultService->add_result($result_data);

        Flight::json(['message' => "You have successfully added the result", 'data' => $result]);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        Flight::json(['error' => $e->getMessage()]);
    }
});


});