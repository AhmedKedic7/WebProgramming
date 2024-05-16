<?php
require_once __DIR__ . '/services/TeamService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_POST;

// Check if 'pFName' field is empty
if (empty($payload['tName'])) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Team Name is required']));
}

try {
    $teamService = new TeamService();

    // Prepare the array for adding a team
    $team_data = [
        ':tName' => $payload['tName'],
        ':coach_Name' => $payload['coach_Name'] ?? null,
        ':numOfPlayers' => $payload['numOfPlayers'] ?? null,
        ':establishment_year' => $payload['establishment_year'] ?? null,
        ':stadium' => $payload['stadium'] ?? null
    ];

    

    // Add player to the database
    $team = $teamService->add_team($team_data);

    echo json_encode(['message' => "You have successfully added the team", 'data' => $team]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>