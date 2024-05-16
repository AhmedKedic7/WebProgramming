<?php

require_once __DIR__ . "/../services/TableService.class.php";

Flight::set("table_service", new PlayerService);

Flight::group("/tables", function() {
    /**
 * @OA\Get(
 *      path="/tables/get_table",
 *      tags={"tables"},
 *      summary="Get table",
 *      description="Retrieve the table data.",
 *      @OA\Response(
 *          response=200,
 *          description="Table data retrieved successfully",
 *          @OA\JsonContent(ref="#/components/schemas/Table")
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

    Flight::route('GET /get_table', function() {
        try {
            $table_service = new TableService();
            $table = $table_service->get_table();
            Flight::json($table);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    });

    /**
 * @OA\Post(
 *      path="/update_table",
 *      tags={"tables"},
 *      summary="Update table",
 *      description="Update table data based on the provided table ID.",
 *      security={
 *          {"ApiKey": {}} 
 *          },
 *      @OA\RequestBody(
 *          required=true,
 *          description="Table data payload",
 *          @OA\JsonContent(
 *              required={"table_id"},
 *              @OA\Property(property="table_id", type="integer", example="1", description="Table ID"),
 *              @OA\Property(property="PL", type="integer", example="10", description="PL"),
 *              @OA\Property(property="W", type="integer", example="8", description="W"),
 *              @OA\Property(property="L", type="integer", example="2", description="L"),
 *              @OA\Property(property="GF", type="integer", example="20", description="GF"),
 *              @OA\Property(property="GA", type="integer", example="10", description="GA"),
 *              @OA\Property(property="GD", type="integer", example="10", description="GD"),
 *              @OA\Property(property="Pts", type="integer", example="24", description="Pts"),
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Table data updated successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="You have successfully updated the table"),
 *              
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request",
 *          @OA\JsonContent(
 *              @OA\Property(property="error", type="string", example="Table ID is required")
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


    Flight::route('POST /update_table', function() {
        $payload = Flight::request()->data->getData();
    
        // Check if required fields are present
        if (empty($payload['table_id'])) {
            Flight::halt(400, json_encode(['error' => 'Table ID is required']));
        }
    
        try {
            $tableService = new TableService();
    
            // Prepare table data for update
            $table_data = [
                ':table_id' => $payload['table_id'],
                ':PL' => $payload['PL'] ?? null,
                ':W' => $payload['W'] ?? null,
                ':L' => $payload['L'] ?? null,
                ':GF' => $payload['GF'] ?? null,
                ':GA' => $payload['GA'] ?? null,
                ':GD' => $payload['GD'] ?? null,
                ':Pts' => $payload['Pts'] ?? null
            ];
    
            // Update table data in the database
            $table = $tableService->update_table($table_data);
    
            Flight::json(['message' => 'Table updated successfully', 'data' => $table]);
        } catch (Exception $e) {
            Flight::halt(500, Flight::json(['error' => $e->getMessage()]));
        }
    });
});    