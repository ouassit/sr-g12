<?php

header("Content-Type: application/json; charset=UTF-8");

require 'vendor/autoload.php';

require_once 'database.php';
require_once 'UserService.php';

$database = new Database();
$db = $database->getConnection();

$baseUri = '/sr-g12/api';
$method = $_SERVER["REQUEST_METHOD"];

if(!isset($_GET['endpoint'])){
    header("HTTP/1.1 404 Not Found");
    exit();
}

$endpoint = $_GET['endpoint'];


$userService = new UserService($db);

switch ($method) {
    case 'GET':
        break;
    case 'POST':
        if($endpoint==='auth'){
            $user = $userService->auth($_POST['username'], $_POST['password']);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
}





