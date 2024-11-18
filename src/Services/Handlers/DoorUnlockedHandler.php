<?php

namespace App\Services\Handlers;

use App\Services\LoggerService;
use App\Services\Communication\SmsService;

class DoorUnlockedHandler
{
    private LoggerService $loggerService;
    private SmsService $smsService;

    public function __construct(LoggerService $loggerService, SmsService $smsService)
    {
        $this->loggerService = $loggerService;
        $this->smsService = $smsService;
    }

    public function handle(array $data): array
    {
        $this->loggerService->logEvent("Zdarzenie doorUnlocked: " . json_encode($data));

        $this->smsService->sendSms("+48532303483", "Drzwi zostały odblokowane.");

        return [
            'status' => 'success',
            'message' => 'Zdarzenie doorUnlocked: zalogowane i wysłano SMS.',
        ];
    }
}

