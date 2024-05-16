<?php

require_once __DIR__ . '/services/FixtureService.class.php';

$fixture_id = $_REQUEST["id"]; // passali smo ga u url (?id=id)

if ($fixture_id == NULL || $fixture_id == "") {
    header("HTTP/1.1 500 Bad Request");
    die(json_encode(["error" => "Invalid fixture id"]));
}

$fixture_service = new FixtureService();

$fixture_service->delete_fixture($fixture_id);

echo json_encode(["message" => "You have successfully deleted a fixture"]);