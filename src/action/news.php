<?php declare(strict_types=1);

namespace action;

include "../service/NewsService.php";
include "../helper/Logger.php";

use Exception;
use exception\DatabaseWritingException;
use Logger;
use service\NewsService;

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !array_key_exists('method', $_POST)) {
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
} catch (DatabaseWritingException $e) {
    Logger::log($e->getMessage());
    echo  json_encode(['success' => false]);
} catch (Exception $e) {
    echo 'Exception'.$e->getMessage();
}






