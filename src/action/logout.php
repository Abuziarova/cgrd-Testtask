<?php declare(strict_types=1);

namespace action;

session_start();
 if(session_destroy()) {
     header('Location: /');
 }
