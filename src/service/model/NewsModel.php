<?php declare(strict_types=1);

namespace service\model;
class NewsModel
{
    private ?int $id;
    private string $title;
    private string $description;

    public function __construct($id, $title, $description)
    {
        if ($id) {
            $this->setId($id);
        }
        $this->setTitle($title);
        $this->setDescription($description);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}