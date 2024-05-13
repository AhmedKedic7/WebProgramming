<?php

require_once __DIR__ . '/services/PlayerService.class.php';

$player_id = $_REQUEST["id"]; // passali smo ga u url (?id=id)

if ($player_id == NULL || $player_id == "") {
    header("HTTP/1.1 500 Bad Request");
    die(json_encode(["error" => "Invalid player id"]));
}

$player_service = new PlayerService();

$player_service->delete_player($player_id);

echo json_encode(["message" => "You have successfully deleted a player"]);
