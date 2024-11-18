<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class LoggerService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logEvent(string $message): void
    {        
        $this->logger->info("Logowanie zdarzenia: {$message}");
    }
}

