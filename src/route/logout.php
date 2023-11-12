<?php declare(strict_types=1);

session_start();
 if(session_destroy()) {
     header('Location: /');
 }
