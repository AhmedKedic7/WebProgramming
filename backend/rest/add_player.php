<?php


require_once __DIR__ . '/services/PlayerService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_POST;

// Check if 'pFName' field is empty
if (empty($payload['pFName'])   ) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Player First Name is required']));
}

try {
    $playerService = new PlayerService();

    // Prepare the array for adding a player
    $player_data = [
        ':pFName' => $payload['pFName'],
        ':playerTeam' => $payload['playerTeam'] ,
        ':nationality' => $payload['nationality'],
        ':height' => $payload['height'] ,
        ':playerPosition' => $payload['playerPosition'] ,
        ':jersey_number' => $payload['jersey_number'] 

    ];

    // Add player to the database
    $player = $playerService->add_player($player_data);

    echo json_encode(['message' => "You have successfully added the player", 'data' => $player]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>