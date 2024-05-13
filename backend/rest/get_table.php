<?php

require_once __DIR__ . '/services/TableService.class.php';

$player_id = $_REQUEST;

$table_service = new TableService();

$table = $table_service->get_table();

echo json_encode($table);