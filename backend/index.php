<?php

require 'vendor/autoload.php';
require 'rest/routes/middleware_routes.php';
require 'rest/routes/players_routes.php';
require 'rest/routes/table_routes.php';
require 'rest/routes/result_routes.php';
require 'rest/routes/fixture_routes.php';
require 'rest/routes/admin_routes.php';
require 'rest/routes/auth_routes.php';



Flight::route('/', function () {
    echo 'hello world!';
});

Flight::route('/web', function () {
    echo 'Kedison!';
});
Flight::start();