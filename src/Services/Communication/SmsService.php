<?php

namespace App\Services\Communication;

use Psr\Log\LoggerInterface;

class SmsService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sendSms(string $phoneNumber, string $message): void
    {
        $this->logger->info("Wysłano SMS na numer {$phoneNumber}: {$message}"); 
     
    }
}
