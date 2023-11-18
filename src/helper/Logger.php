<?php declare(strict_types=1);

namespace helper;

class Logger
{
    public static function log(string $data): void
    {
        $file = __DIR__ . '/logs/log-' . date('mdY') . '.txt';
        $date = date('m/d/Y h:i:s a', time());
        if (!is_file($file)) {
            touch($file);
        }
        file_put_contents($file, $date.': '.$data . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}