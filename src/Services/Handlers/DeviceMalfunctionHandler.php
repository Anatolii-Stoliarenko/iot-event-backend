<?php

namespace App\Services\Handlers;

use App\Services\LoggerService;
use App\Services\Communication\EmailService;

class DeviceMalfunctionHandler
{
    private LoggerService $loggerService;
    private EmailService $emailService;

    public function __construct(LoggerService $loggerService, EmailService $emailService)
    {
        $this->loggerService = $loggerService;
        $this->emailService = $emailService;
    }

    public function handle(array $data): array
    {
        $this->loggerService->logEvent("Zdarzenie deviceMalfunction: " . json_encode($data));

        $this->emailService->sendEmail("recipient@example.com", "Zdarzenie deviceMalfunction", "Treść wiadomości o zdarzeniu...");

        return [
            'status' => 'success',
            'message' => 'Zdarzenie deviceMalfunction: zalogowane i wysłano e-mail.',
        ];
    }
}


