<?php
require_once __DIR__ . "/../services/AuthService.class.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set("auth_service", new AuthService);

Flight::group('/auth', function(){
    /**
 * @OA\Post(
 *     path="/auth/login",
 *     tags={"auth"},
 *     summary="Login to system using username and password",
 *     description="Add a new admin with the provided data.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Admin data",
 *         @OA\JsonContent(
 *             required={"uname","password"},
 *             
 *             
 *             @OA\Property(property="uName", type="string", example="johndoe"),
 *             
 *             @OA\Property(property="adPswd", type="string", example="some_password")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Succes response or exception if unable to verify jwt token",
 *         
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
    Flight::route('POST /login' , function(){

      
        

            $payload = Flight::request()->data->getData();
            $authService = Flight::get('auth_service');
            
            // Fetch admin data based on the username provided
            $admin = $authService->get_admin_by_username($payload['uName']);
            
        
            // Check if admin data was found
            if (!$admin) {
                Flight::halt(404, "Admin not found");
            }
        
            // Check if the provided password matches the hashed password stored in the database
            if (!password_verify($payload['adPswd'], $admin['password'])) {
                Flight::halt(500, "Invalid password");
            }
        
        $jwt_payload=[
            'user'=>$admin,
            'iat'=>time(),
            'exp'=>time()+(60*60*24)
        ];

        $token=JWT::encode(
            $jwt_payload,
            Config::JWT_SECRET(),
            'HS256'
        );

        Flight::json(
            array_merge($admin, ['token'=>$token])
        );
    });
           /**
 * @OA\Post(
 *     path="/auth/logout",
 *     tags={"auth"},
 *     summary="Logout from system-",
 *     description="Add a new admin with the provided data.",
 *     security={
 *          {"ApiKey": {}} 
 *          },
 *     
 *     @OA\Response(
 *         response=200,
 *         description="Success or exception",
 *         
 *     ),
 *     
 * )
 */
    Flight::route('POST /logout',function(){
        try{
            $token = Flight::request()->getHeader("Authentication");
            if(!$token)
                Flight::halt(401,"Missing authentication header");
            $decoded_token=JWT::decode($token, new Key(Config::JWT_SECRET(),'HS256'));

            Flight::json([
                'jwt_decoded'=>$decoded_token,
                'user'=>$decoded_token->user
            ]
            
            );
        }catch(\Exception $e){
            Flight::halt(401,$e->getMessage());
        }
    });
    
});