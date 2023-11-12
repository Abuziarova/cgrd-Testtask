<?php declare(strict_types=1);

class DatabaseConnection {
    private  $server = 'mysql';
    private  $username = 'app';
    private $pwd = 'app';
    private $db_name = 'database';

    private $db;
    public function __construct() {
        $this->db = new mysqli($this->server, $this->username, $this->pwd,$this->db_name);
    }

    public function getDbConnection()
    {
        return $this->db;
    }
}



