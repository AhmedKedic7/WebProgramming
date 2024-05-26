<?php
require_once __DIR__ . "/../services/AdminService.class.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set("admin_service", new AdminService);

Flight::group("/admins",function(){
    /**
 * @OA\Get(
 *     path="/admins/all",
 *     tags={"admins"},
 *     summary="Get all admins",
 *     description="Retrieve all admins from the server.",
 *     security={
 *          {"ApiKey": {}} 
 *          },
 *     @OA\Response(
 *         response=200,
 *         description="An array of all admins",
 *         @OA\JsonContent(
 *             type="array",
 *             
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="error",
 *                 type="string"
 *             )
 *         )
 *     )
 * )
 */


Flight::route("GET /all", function() {
    /*try{
        $token = Flight::request()->getHeader("Authentication");
        if(!$token)
            Flight::halt(401,"Missing authentication header");
            $decoded_token=JWT::decode($token, new Key(JWT_SECRET,'HS256'));

        Flight::json([
            'jwt_decoded'=>$decoded_token,
            'user'=>$decoded_token->user
        ]
        
        );
    }catch(\Exception $e){
        Flight::halt(401,$e->getMessage());
    }*/
    try {
        // Assuming you have a method in your AdminService to retrieve all admins
        $adminService = new AdminService();
        $admins = $adminService->get_all_admins();

        // Respond with the retrieved admins in JSON format
        Flight::json($admins);
    } catch (Exception $e) {
        // If an error occurs, respond with a 500 Internal Server Error and an error message
        Flight::halt(500, $e->getMessage());
    }
});

/**
 * @OA\Post(
 *     path="/admins/add",
 *     tags={"admins"},
 *     summary="Add a new admin",
 *     description="Add a new admin with the provided data.",
 *     security={
 *          {"ApiKey": {}} 
 *          },
 *     @OA\RequestBody(
 *         required=true,
 *         description="Admin data",
 *         
 *         @OA\JsonContent(
 *             required={"fName"},
 *             @OA\Property(property="fName", type="string", example="John"),
 *             @OA\Property(property="sName", type="string", example="Doe"),
 *             @OA\Property(property="adminAccess", type="string", example="true"),
 *             @OA\Property(property="uName", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *             @OA\Property(property="adminRole", type="string", example="admin"),
 *             @OA\Property(property="accStatus", type="string", example="active"),
 *             @OA\Property(property="adPswd", type="string", example="password")
 *             
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Admin added successfully",
 *        
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Admin First Name is required")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Internal Server Error")
 *         )
 *     )
 * )
 */


Flight::route("POST /add", function() {
    // Retrieve the payload data from the request
    $payload = Flight::request()->data->getData();

    // Check if the required fields are empty
    if (empty($payload['fName'])) {
        // If required fields are empty, return a 400 Bad Request response
        Flight::halt(400, json_encode(['error' => 'Admin First Name is required']));
    }

    try {
        // Create an instance of AdminService
        $adminService = new AdminService();

        // Prepare the data for adding an admin
        $admin_data = [
            ':fName' => $payload['fName'],
            ':sName' => $payload['sName'] ?? null,
            ':adminAccess' => $payload['adminAccess'] ?? null,
            ':uName' => $payload['uName'] ?? null,
            ':email' => $payload['email'] ?? null,
            ':adminRole' => $payload['adminRole'] ?? null,
            ':accStatus' => $payload['accStatus'] ?? null,
            ':adPswd' => $payload['adPswd'] ?? null
        ];

        // Add admin to the database
        $admin = $adminService->add_admin($admin_data);

        // Return a success response with the added admin data
        Flight::json(['message' => "You have successfully added the admin", 'data' => $admin]);
    } catch (Exception $e) {
        // If an exception occurs, return a 500 Internal Server Error response
        Flight::halt(500, json_encode(['error' => $e->getMessage()]));
    }
});

/**
 * @OA\Delete(
 *     path="/admins/delete/{admin_id}",
 *     tags={"admins"},
 *     summary="Delete an admin",
 *     description="Delete an admin by ID.",
 *     security={
 *          {"ApiKey": {}} 
 *          },
 *     @OA\Parameter(
 *         name="admin_id",
 *         in="path",
 *         required=true,
 *         description="ID of the admin to delete",
 *         @OA\Schema(type="integer",example="2")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Admin deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="You have successfully deleted an admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid admin ID",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Invalid admin id")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Internal Server Error")
 *         )
 *     )
 * )
 */

Flight::route("DELETE /delete/@admin_id", function($admin_id) {
    
    $adminService = Flight::get("admin_service");
    
    try {
        $adminService->delete_admin($admin_id);
        Flight::json(["message" => "You have successfully deleted an admin"]);
    } catch (Exception $e) {
        Flight::halt(500, $e->getMessage());
    }
});

});