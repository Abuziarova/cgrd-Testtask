<?php declare(strict_types=1);

$request = $_SERVER['REQUEST_URI'];
$routeDir = '/src/route/';

switch ($request) {
    case '/':
        require __DIR__ . $routeDir. 'login.php';
        break;

    case '/logout':
        require __DIR__ . $routeDir. 'logout.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $routeDir. '404.php';
}