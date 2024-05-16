<?php

require_once __DIR__ . '/services/ResultService.class.php';

$payload = $_REQUEST;

$result_service = new ResultService();

$data = $result_service->get_all_results();

echo json_encode($data);
