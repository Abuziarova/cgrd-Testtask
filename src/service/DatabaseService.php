<?php declare(strict_types=1);

namespace service;

use Exception;
use model\NewsModel;
use exception\DatabaseWritingException;
use mysqli;

class DatabaseService
{
    private const SERVER = 'mysql';
    private const USERNAME = 'app';
    private const PASSWORD = 'app';
    private const DATABASE_NAME = 'database';

    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new mysqli(
            self::SERVER,
            self::USERNAME,
            self::PASSWORD,
            self::DATABASE_NAME
        );
    }

    public function getUserByUserData(string $login, string $password): ?string
    {
        $sql = sprintf("SELECT id FROM user WHERE login = '%s' and password = '%s'", $login, md5($password));
        $result = mysqli_query($this->dbConnection, $sql);

        return mysqli_num_rows($result) === 1 ? $login : null;
    }

    public function createNews(NewsModel $news): bool
    {
        $sql = sprintf("INSERT INTO news(title, description) values('%s', '%s');",
            $news->getTitle(),
            $news->getDescription()
        );

        return $this->handleQuery($sql, 'creating new news');
    }

    public function getAllNews(): object
    {
        $sql = "SELECT * from news;";

        return $this->handleQuery($sql, 'getting all news');
    }

    public function deleteNews($id): bool
    {
        $sql = sprintf("DELETE FROM news WHERE id = '%d'", $id);

        return $this->handleQuery($sql, 'deleting news', $id);
    }

    public function editNews(NewsModel $news): bool
    {
        $sql = sprintf(
            "UPDATE news SET title='%s', description='%s' where id = '%d'",
            $news->getTitle(),
            $news->getDescription(),
            $news->getId()
        );

        return $this->handleQuery($sql, 'updating news', $news->getId());
    }

    public function handleQuery(string $sql, string $method , $id = null): bool|object
    {
        try {
            $result = mysqli_query($this->dbConnection, $sql);
            return $result;
        } catch (Exception $exception) {
            throw new DatabaseWritingException($exception->getMessage(), $method, $id);
        }
    }
}



