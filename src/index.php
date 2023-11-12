<?php declare(strict_types=1);

session_start();

require __DIR__ . '/vendor/autoload.php';
include "service/config.php";

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$request = $_SERVER['REQUEST_URI'];
$routeDir = '/route/';

$loader = new FilesystemLoader(__DIR__ . '/view');
$twig = new Environment($loader);
$logged = false;
$errorMessage = null;

if (isset($_SESSION['login_user'])) {
    $logged = true;
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $connection = new DatabaseConnection();
    $db = $connection->getDbConnection();
    $myusername = mysqli_real_escape_string($db,$_POST['login']);
    $mypassword = mysqli_real_escape_string($db,md5($_POST['password']));
    $sql = "SELECT id FROM user WHERE login = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $count = mysqli_num_rows($result);

    if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $logged = true;
    }else {
        $errorMessage = "Wrong Login Data!";
    }
}
echo $twig->render('main.html.twig', ['logged' => $logged, 'errorMessage' => $errorMessage]);


