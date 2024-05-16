<?php

require_once __DIR__ . '/services/FixtureService.class.php';

$payload = $_REQUEST;

$fixture_service = new FixtureService();

$data = $fixture_service->get_all_fixtures();

echo json_encode($data);