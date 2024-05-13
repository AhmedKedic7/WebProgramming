<?php

require_once __DIR__ . "/../services/PlayerService.class.php";

Flight::set("player_service", new PlayerService);

Flight::group("/players", function() {

    /**
     * @OA\Get(
     *      path="/players/all",
     *      tags={"players"},
     *      summary="Get all players",
     *      @OA\Response(
     *           response=200,
     *           description="Get all players"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal Server Error")
     *          )
     *      )
     * )
     */
    
    Flight::route("GET /all", function() {
        
        $data = Flight::get("player_service")->get_all_players();
        Flight::json($data);
    });

    /**
     * @OA\Post(
     *      path="/players/add",
     *      tags={"players"},
     *      summary="Add a player",
     *      @OA\Response(
     *           response=200,
     *           description="Input the player info and add the player to the database"
     *      ),
     *      @OA\RequestBody(
     *          description="User data payload",
     *          @OA\JsonContent(
     *              required={"pFName", "playerTeam"},
     *              @OA\Property(property="pFName", type="string", example="John", description="Player's first name"),
     *              @OA\Property(property="playerTeam", type="string", example="TeamName", description="Player's team"),
     *              @OA\Property(property="nationality", type="string", example="Country", description="Player's nationality"),
     *              @OA\Property(property="height", type="integer", example=180, description="Player's height in cm"),
     *              @OA\Property(property="playerPosition", type="string", example="Forward", description="Player's position"),
     *              @OA\Property(property="jersey_number", type="integer", example=10, description="Player's jersey number")
     *          )
     *      )
     * )
     */
    Flight::route("POST /add", function() {
        $payload = Flight::request()->data->getData();
    
        if (empty($payload["pFName"])) {
            Flight::halt(400, "Player First Name is required");
        }
    
        $playerService = Flight::get("player_service");
    
        try {
            $player_data = [
                'pFName' => $payload['pFName'],
                'playerTeam' => $payload['playerTeam'] ?? null,
                'nationality' => $payload['nationality'] ?? null,
                'height' => $payload['height'] ?? null,
                'playerPosition' => $payload['playerPosition'] ?? null,
                'jersey_number' => $payload['jersey_number'] ?? null
            ];
    
            $player = $playerService->add_player($player_data);
    
            Flight::json([
                "message" => "You have successfully added the player",
                "data" => $player
            ]);
        } catch (Exception $e) {
            Flight::halt(500, $e->getMessage());
        }
    });

    /**
 * @OA\Delete(
 *      path="/players/delete/{player_id}",
 *      tags={"players"},
 *      summary="Delete player by ID",
 *      @OA\Response(
 *           response=200,
 *           description="Delete the player with the specified ID from the database, or get 'Invalid player id'"
 *      ),
 *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="player_id", example="1273", description="Player ID")
 * )
 */
Flight::route("DELETE /delete/@player_id", function($player_id) {
    if ($player_id == NULL || $player_id == "") {
        Flight::halt(400, "Invalid player id");
    }
    
    $playerService = Flight::get("player_service");
    
    try {
        $playerService->delete_player($player_id);
        Flight::json(["message" => "You have successfully deleted a player"]);
    } catch (Exception $e) {
        Flight::halt(500, $e->getMessage());
    }
});
/**
 * @OA\Get(
 *      path="/get_player/{player_id}",
 *      tags={"players"},
 *      summary="Get player by ID",
 *      description="Returns player data based on the provided player ID.",
 *      @OA\Parameter(
 *          name="player_id",
 *          in="path",
 *          required=true,
 *          description="ID of the player to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Player data retrieved successfully",
 *          @OA\JsonContent(ref="#/components/schemas/Player")
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Invalid player ID provided"
 *      )
 * )
 */


Flight::route("GET /get_player/@player_id", function($player_id) {
    if ($player_id == NULL || $player_id == "") {
        Flight::halt(400, json_encode(["error" => "Invalid player id"]));
    }

    $player_service = new PlayerService();
    $player = $player_service->get_player_by_id($player_id);

    Flight::json($player);
});

/**
 * @OA\Post(
 *      path="/update_player",
 *      tags={"players"},
 *      summary="Update player",
 *      description="Update player information based on the provided payload.",
 *      @OA\RequestBody(
 *          required=true,
 *          description="Player data payload",
 *          @OA\JsonContent(
 *              required={"player_id", "pFName"},
 *              @OA\Property(property="player_id", type="integer", example="1", description="Player ID"),
 *              @OA\Property(property="pFName", type="string", example="John", description="Player First Name"),
 *              @OA\Property(property="playerTeam", type="string", example="Team A", description="Player Team (optional)"),
 *              @OA\Property(property="nationality", type="string", example="USA", description="Player Nationality (optional)"),
 *              @OA\Property(property="height", type="integer", example="190", description="Player Height (optional)"),
 *              @OA\Property(property="playerPosition", type="string", example="Forward", description="Player Position (optional)"),
 *              @OA\Property(property="jersey_number", type="integer", example="7", description="Player Jersey Number (optional)")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Player updated successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Player updated successfully"),
 *              @OA\Property(property="data", type="object", ref="#/components/schemas/Player")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Player ID and Player First Name are required",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Player ID and Player First Name are required")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Internal Server Error")
 *          )
 *      )
 * )
 */


Flight::route('POST /update_player', function() {
    // Get the payload from the request
    $payload = Flight::request()->data->getData();

    // Check if 'pFName' field is empty
    if (empty($payload['pFName'])) {
        Flight::halt(400, json_encode(['error' => 'Player First Name is required']));
    }

    try {
        $playerService = new PlayerService();

        // Check if player ID is provided
        if (empty($payload['player_id'])) {
            Flight::halt(400, json_encode(['error' => 'Player ID is required']));
        }

        // Prepare the array for updating a player
        $player_data = [
            ':player_id' => $payload['player_id'],
            ':pFName' => $payload['pFName'],
            ':playerTeam' => $payload['playerTeam'] ?? null,
            ':nationality' => $payload['nationality'] ?? null,
            ':height' => $payload['height'] ?? null,
            ':playerPosition' => $payload['playerPosition'] ?? null,
            ':jersey_number' => $payload['jersey_number'] ?? null
        ];

        // Update player in the database
        $player = $playerService->update_player($player_data);

        // Return success message and updated player data
        Flight::json(['message' => "You have successfully updated the player", 'data' => $player]);
    } catch (Exception $e) {
        // Handle any exceptions
        Flight::halt(500, Flight::json(['error' => $e->getMessage()]));
    }
});

});