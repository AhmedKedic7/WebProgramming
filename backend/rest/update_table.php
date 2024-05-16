<?php

require_once __DIR__ . '/services/TableService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_REQUEST;

try {
    $tableService = new TableService();

    // Check if player ID is provided
    if (empty($payload['table_id'])) {
        header('HTTP/1.1 400 Bad Request');
        die(json_encode(['error' => 'Table ID is required']));
    }

    // Prepare the array for updating table data
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

    echo json_encode(['message' => "You have successfully updated the table", 'data' => $table]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>


