<?php

namespace App\Services\Communication;

use Psr\Log\LoggerInterface;

class RestRequestService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logRequest(string $message): void
    {
        $this->logger->info("Logowanie żądania REST: {$message}");
    }
}
