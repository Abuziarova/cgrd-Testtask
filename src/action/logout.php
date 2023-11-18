<?php declare(strict_types=1);

namespace action;
include "../helper/Logger.php";

session_start();

 if(session_destroy()) {
     header('Location: /');
 }
