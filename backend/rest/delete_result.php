<?php

require_once __DIR__ . '/services/ResultService.class.php';

$result_id = $_REQUEST["id"]; // passali smo ga u url (?id=id)

if ($result_id == NULL || $result_id == "") {
    header("HTTP/1.1 500 Bad Request");
    die(json_encode(["error" => "Invalid result id"]));
}

$result_service = new ResultService();

$result_service->delete_result($result_id);

echo json_encode(["message" => "You have successfully deleted a result"]);