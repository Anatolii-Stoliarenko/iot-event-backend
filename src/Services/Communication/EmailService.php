<?php

namespace App\Services\Communication;

use Psr\Log\LoggerInterface;

class EmailService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sendEmail(string $recipientEmail, string $subject, string $message): void
    {
        $this->logger->info("Wysłano e-mail do {$recipientEmail} z tematem '{$subject}': {$message}");
    }
}