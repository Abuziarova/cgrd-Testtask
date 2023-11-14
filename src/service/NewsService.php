<?php declare(strict_types=1);

include "DatabaseService.php";

include "../model/News.php";
class NewsService
{
    private $databaseService;
    public function __construct() {
        $this->databaseService = new DatabaseService();
    }

   public function add(string $title, string $description): string
   {
       $responseData =['success' => true, 'message' => 'The news were created'];

       if (!$title || !$description) {
           $responseData =['success' => false, 'message' => 'Missing data'];
       } else {
           $news = new News;
           $news->setTitle($title);
           $news->setDescription($description);
           try {
               $this->databaseService->createNews($news);
           } catch (Exception $exception) {
               $responseData =['success' => false, 'message' => $exception->getMessage()];
           }
       }

       return $this->createResponse($responseData);
   }

    public function edit(mixed $id, mixed $title, mixed $description): string
    {
        $data =['success' => true, 'message' => 'The news were created'];
        return $this->createResponse($data);
    }

    public function delete(mixed $id)
    {
        $data =['success' => true, 'message' => 'The news were created'];
        return $this->createResponse($data);
    }

    private function createResponse(array $data): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($data);
    }
}