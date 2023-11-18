<?php declare(strict_types=1);

namespace service\exception;

use Exception;

class DatabaseWritingException extends Exception
{
    public function __construct(string $errorMessage, string $method, int $id = null)
    {
        $message = 'Error during '.$method;
        if ($id) {
            $message = $message.' Id enitity: '.$id;
        }
        $message = $message.' Error message: '.$errorMessage;
        parent::__construct($message);
    }
}