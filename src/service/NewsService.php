<?php declare(strict_types=1);

namespace service;

use service\model\NewsModel;

include_once "DatabaseService.php";
include "model/NewsModel.php";
include "exception/DatabaseWritingException.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class NewsService
{
    private DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    public function add(string $title, string $description): string
    {
        $news = new NewsModel(null, $title, $description);
        $this->databaseService->createNews($news);
        $_SESSION['success_message'] = 'News was successfully created';

        return $this->createSuccessResponse();
    }

    public function edit(string $id, string $title, string $description): string
    {
        $news = new NewsModel((int)$id, $title, $description);
        $this->databaseService->editNews($news);
        $_SESSION['success_message'] = 'News was successfully changed';

        return $this->createSuccessResponse();
    }

    public function delete(string $id): string
    {
        $this->databaseService->deleteNews((int)$id);
        $_SESSION['success_message'] = 'News was successfully deleted';

        return $this->createSuccessResponse();
    }

    private function createSuccessResponse(): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode(['success' => true]);
    }

    public function getNews()
    {
        $newsData = [];
        $data = $this->databaseService->getAllNews();
        foreach ($data as $news) {
            $newsData[] = new NewsModel((int)$news['id'], $news['title'], $news['description']);
        }

        return $newsData;
    }
}