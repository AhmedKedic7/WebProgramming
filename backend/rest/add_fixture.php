<?php

require_once __DIR__ . '/services/FixtureService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_POST;

// Check if 'pFName' field is empty
if (empty($payload['home_team_fixture_id']) or empty($payload['away_team_fixture_id']) ) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Home Team Name is required']));
}

try {
    $fixtureService = new FixtureService();

    // Prepare the array for adding an admin
    $fixture_data = [
        ':home_team_fixture_id' => $payload['home_team_fixture_id'] ,
        ':away_team_fixture_id' => $payload['away_team_fixture_id'] ?? null,
        ':matchDate' => $payload['matchDate'] ?? null,
        ':matchWeek' => $payload['matchWeek'] ?? null,
        ':matchTime' => $payload['matchTime'] ?? null

    ];

    // Add admin to the database
    $fixture = $fixtureService->add_fixture($fixture_data);

    echo json_encode(['message' => "You have successfully added the fixture", 'data' => $admin]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>