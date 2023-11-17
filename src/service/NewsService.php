<?php declare(strict_types=1);
session_start();
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

            $_SESSION['success_message'] = 'News was successfully created';
        } catch (Exception $exception) {
            $responseData = ['success' => false];
        }

        return $this->createResponse($responseData);
    }

    public function edit(string $id, string $title, string $description): string
    {
          if ($this->databaseService->editNews((int)$id, $title, $description)) {
              $responseData = ['success' => true];
              $_SESSION['success_message'] = 'News was successfully changed';
          } else {
              $responseData = ['success' => false];
          }

        return $this->createResponse($responseData);
    }

    public function delete(string $id)
    {
        try {
            $this->databaseService->deleteNews((int)$id);
            $responseData = ['success' => true];
            $_SESSION['success_message'] = 'News was successfully deleted';
        } catch (Exception $exception) {
            $responseData = ['success' => false];
        }

        return $this->createResponse($responseData);
    }

    private function createResponse(array $data): string
    {
//        header('Content-Type: application/json; charset=utf-8');
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