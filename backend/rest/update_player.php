<?php

require_once __DIR__ . '/services/PlayerService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_REQUEST;

// Check if 'pFName' field is empty
if (empty($payload['pFName'])) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Player First Name is required']));
}

try {
    $playerService = new PlayerService();

    // Check if player ID is provided
    if (empty($payload['player_id'])) {
        header('HTTP/1.1 400 Bad Request');
        die(json_encode(['error' => 'Player ID is required']));
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

    echo json_encode(['message' => "You have successfully updated the player", 'data' => $player]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
