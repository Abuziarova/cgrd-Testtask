<?php declare(strict_types=1);

session_start();

require __DIR__ . '/vendor/autoload.php';
include "service/LoginService.php";
include "service/NewsService.php";

use service\LoginService;
use service\NewsService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$request = $_SERVER['REQUEST_URI'];
$routeDir = '/route/';

$loader = new FilesystemLoader(__DIR__ . '/view');
$twig = new Environment($loader);

$errorMessage = null;
$logged = false;
if (isset($_SESSION['login_user'])) {
    $logged = true;
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginHandler = new LoginService();
    $errorMessage = $loginHandler->login($_POST['login'], $_POST['password']);
    $logged = $errorMessage === null;
}

$veiwVariables = ['logged' => $logged, 'errorMessage' => $errorMessage];


if($logged) {
    $newsService = new NewsService();
    $veiwVariables ['news'] = $newsService->getNews();
}

if (isset($_SESSION['success_message'])) {
    $veiwVariables['successMessage'] = $_SESSION['success_message'];
}

echo $twig->render('main.html.twig', $veiwVariables);

$_SESSION['success_message'] = null;


