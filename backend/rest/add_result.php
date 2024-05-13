<?php


require_once __DIR__ . '/services/ResultService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_POST;


if (empty($payload['home_team_id']) or empty($payload['away_team_id'])) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Team Name is required']));
}

try {
    $resultService = new ResultService();

    // Prepare the array for adding a result
    $result_data = [
        ':home_team_id' => $payload['home_team_id'],
        ':away_team_id' => $payload['away_team_id'] ,
        ':home_team_score' => $payload['home_team_score'] ?? null,
        ':away_team_score' => $payload['away_team_score'] ?? null
        ];

    // Add result to the database
    $result = $resultService->add_result($result_data);

    echo json_encode(['message' => "You have successfully added the result", 'data' => $result]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}

?>