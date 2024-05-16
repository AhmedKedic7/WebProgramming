<?php

require_once __DIR__ . '/services/PlayerService.class.php';

$player_id = $_REQUEST["id"];

$player_service = new PlayerService();

$player = $player_service->get_player_by_id($player_id);

// ovo treba da bi edit dugme radilo, inace returna text, a mi hocemo da nam returna json kako bi
// mogli accessat sa data.id, data.name,...
header('Content-Type: application/json');

echo json_encode($player);