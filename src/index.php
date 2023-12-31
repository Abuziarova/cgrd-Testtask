<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
include "service/LoginService.php";
include "service/NewsService.php";
include "helper/Logger.php";

use service\LoginService;
use service\NewsService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

if(!isset($_SESSION["csrf_token"])) {
    $token = bin2hex(random_bytes(16));
    $_SESSION["csrf_token"] = $token;
} else {
    $token = $_SESSION["csrf_token"];
}

if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
}

$veiwVariables = ['logged' => $logged, 'errorMessage' => $errorMessage, 'token' => $token];

if($logged) {
    $newsService = new NewsService();
    $veiwVariables ['news'] = $newsService->getNews();
}

if (isset($_SESSION['success_message'])) {
    $veiwVariables['successMessage'] = $_SESSION['success_message'];
}

echo $twig->render('main.html.twig', $veiwVariables);

$_SESSION['success_message'] = null;
$_SESSION['error_message'] = null;


