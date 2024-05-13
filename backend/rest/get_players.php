<?php


require_once __DIR__ . '/services/PlayerService.class.php';

$payload =$_REQUEST;



$player_service = new PlayerService();

$data = $player_service->get_all_players();



echo json_encode($data);