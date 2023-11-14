<?php declare(strict_types=1);

class DatabaseService {
    private const SERVER = 'mysql';
    private const USERNAME = 'app';
    private const PASSWORD = 'app';
    private const DATABASE_NAME= 'database';

    private $dbConnection;
    public function __construct() {
        $this->dbConnection = new mysqli(
            self::SERVER,
            self::USERNAME,
            self::PASSWORD,
            self::DATABASE_NAME
        );
    }

    public function getUserByUserData(string $login, string $password): ?string
    {
        $sql = sprintf("SELECT id FROM user WHERE login = '%s' and password = '%s'",$login, md5($password));
        $result = mysqli_query($this->dbConnection, $sql);

        return mysqli_num_rows($result) === 1 ? $login : null;
    }

    public function createNews(News $news)
    {
        $sql = sprintf("INSERT INTO news(title, description) values('%s', '%s');",
            $news->getTitle(),
            $news->getDescription()
        );
        mysqli_query($this->dbConnection, $sql);
    }

}



