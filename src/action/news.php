<?php declare(strict_types=1);

namespace action;

include "../service/NewsService.php";
include "../helper/Logger.php";

use Exception;
use helper\Logger;
use service\exception\DatabaseWritingException;
use service\NewsService;

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !array_key_exists('method', $_POST)) {
    return;
}

if ($_POST["csrf_token"] != $_SESSION["csrf_token"]) {
    unset($_SESSION["csrf_token"]);
    Logger::log("CSRF token validation failed");
    return;
}

$newsService = new NewsService();

try {
    switch ($_POST['method']) {
        case 'add':
            echo $newsService->add($_POST['title'], $_POST['description']);
            break;
        case 'edit':
            echo $newsService->edit($_POST['id'], $_POST['title'], $_POST['description']);
            break;
        case 'delete':
            echo $newsService->delete($_POST['id']);
            break;
    }
} catch (DatabaseWritingException | Exception $e) {
    Logger::log($e->getMessage());
    echo  json_encode(['success' => false]);
}






