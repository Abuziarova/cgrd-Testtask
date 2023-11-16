<?php declare(strict_types=1);

include "../service/NewsService.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !array_key_exists('method', $_POST)) {
    return;
}
$newsService = new NewsService();

switch ($_POST['method']) {
    case 'add':
        return $newsService->add($_POST['title'], $_POST['description']);
    case 'edit':
        return $newsService->edit($_POST['id'], $_POST['title'], $_POST['description']);
    case 'delete':
        return $newsService->delete($_POST['id']);
}




