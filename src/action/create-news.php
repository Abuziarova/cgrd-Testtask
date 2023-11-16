<?php declare(strict_types=1);

include "../service/NewsService.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    return;
}

$newsService = new NewsService();

echo $newsService->add($_POST['title'], $_POST['description']);
