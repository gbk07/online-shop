<?php

namespace Service;
use Throwable;
class LoggerService
{
    private string $logger;
    public function __construct()
    {
        $this->logger = __DIR__ . '/../Storage/Logs/errors.txt';
    }
    public function error(Throwable $exception):void
    {
        $message = "message: ". $exception->getMessage() . "\n";
        $message .= "file: ". $exception->getFile() . "\n";
        $message .= "line: " . $exception->getLine() . "\n";
        $message .= "code: " . $exception->getCode() . "\n";
        $message .= "dateTime:" . date('Y/m/d H:i:s') . "\n\n";
        file_put_contents($this->logger, $message, FILE_APPEND | LOCK_EX);
    }
}