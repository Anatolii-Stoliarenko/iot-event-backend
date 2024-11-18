<?php

namespace App\Services\Handlers;

use App\Services\LoggerService;
use App\Services\Communication\RestRequestService;

class TemperatureExceededHandler
{
    private LoggerService $loggerService;
    private RestRequestService $restRequestService;


    public function __construct(LoggerService $loggerService, RestRequestService $restRequestService)
    {
        $this->loggerService = $loggerService;
        $this->restRequestService = $restRequestService;
    }

    public function handle(array $data): array
    {
        // Logowanie
        $this->loggerService->logEvent("Zdarzenie temperatureExceeded: " . json_encode($data));

        // Wyslanie rest request
        $this->restRequestService->logRequest("Zdarzenie temperatureExceeded: " . json_encode($data));

        // Zwrócenie odpowiedzi
        return [
            'status' => 'success',
            'message' => 'Zdarzenie temperatureExceeded: zalogowane i wysłano żądanie REST.',
        ];
    }
}

