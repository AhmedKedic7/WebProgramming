<?php

require_once __DIR__ . '/services/PlayerService.class.php';

$payload = $_POST;

if (empty($payload['pFName']) || empty($payload['playerTeam']) || empty($payload['nationality']) || empty($payload['height']) || empty($payload['playerPosition'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'All fields are required']);
    exit;
}

$playerService = new PlayerService();

// Prepare the array for adding a player
$player_data = [
    ':pFName' => $payload['pFName'],
    ':playerTeam' => $payload['playerTeam'],
    ':nationality' => $payload['nationality'],
    ':height' => $payload['height'],
    ':playerPosition' => $payload['playerPosition']
];

// Add player to the database
$player = $playerService->add_player($player_data);

echo json_encode(['message' => "You have successfully added the player", 'data' => $player]);
?>