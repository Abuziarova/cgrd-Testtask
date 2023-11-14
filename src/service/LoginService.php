<?php declare(strict_types=1);

include "DatabaseService.php";

class LoginService
{
    private $databaseService;
    private ?string $errorMessage = null;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    public function login(string $login, string $password)
    {
        $userName = $this->databaseService->getUserByUserData($login, $password);

        if ($userName) {
            $_SESSION['login_user'] = $userName;
        } else {
            $this->errorMessage = "Wrong Login Data!";
        }

        return $this->errorMessage;
    }
}