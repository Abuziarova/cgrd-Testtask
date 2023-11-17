<?php declare(strict_types=1);

include "../service/NewsService.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !array_key_exists('method', $_POST)) {
    return;
}

$newsService = new NewsService();

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




