<?php declare(strict_types=1);

class Logger
{
    public static function log(string $data) {
        $file  =  __DIR__.'/logs/log-'.date('mdY').'.txt';
        if(!is_file($file)){
           touch($file);
        }
        file_put_contents($file, $data.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}