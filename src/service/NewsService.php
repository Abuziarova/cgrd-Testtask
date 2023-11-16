<?php declare(strict_types=1);

include_once "DatabaseService.php";
include "NewsModel.php";

class NewsService
{
    private $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    public function add(string $title, string $description): string
    {
        $news = new NewsModel(null, $title, $description);
        try {
            $this->databaseService->createNews($news);
            $responseData = ['success' => true];
            session_start();
            $_SESSION['success_message'] = 'News was Successfully created';
        } catch (Exception $exception) {
            $responseData = ['success' => false];
        }

        return $this->createResponse($responseData);
    }

    public function edit(mixed $id, mixed $title, mixed $description): string
    {
        $data = ['success' => true, 'message' => 'The news were created'];
        return $this->createResponse($data);
    }

    public function delete(string $id)
    {
        try {
            $this->databaseService->deleteNews((int)$id);
            $responseData = ['success' => true];
        } catch (Exception $exception) {
            $responseData = ['success' => false];
        }

        return $this->createResponse($responseData);
    }

    private function createResponse(array $data): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($data);
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