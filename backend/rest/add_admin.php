<?php


require_once __DIR__ . '/services/AdminService.class.php';

// Log received POST data for debugging
error_log('Received POST data: ' . json_encode($_POST));

$payload = $_POST;

// Check if 'pFName' field is empty
if (empty($payload['fName'])) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Admin First Name is required']));
}

try {
    $adminService = new AdminService();

    // Prepare the array for adding an admin
    $admin_data = [
        ':fName' => $payload['fName'],
        ':sName' => $payload['sName'] ?? null,
        ':uName' => $payload['uName'] ?? null,
        ':email' => $payload['email'] ?? null,
        ':adminRole' => $payload['adminRole'] ?? null,
        ':adminAccess' => $payload['adminAccess'] ?? null,
        ':accStatus' => $payload['accStatus'] ?? null,
        ':password' => $payload['password'] ?? null

    ];

    // Add admin to the database
    $admin = $adminService->add_admin($admin_data);

    echo json_encode(['message' => "You have successfully added the admin", 'data' => $admin]);
} catch (Exception $e) {
    // Handle any exceptions
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>