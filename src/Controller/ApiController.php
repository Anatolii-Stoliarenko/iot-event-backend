<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Validators\EventValidationService;
use App\Services\Handlers\{
    DeviceMalfunctionHandler,
    TemperatureExceededHandler,
    DoorUnlockedHandler
};


class ApiController extends AbstractController
{
    private EventValidationService $validationService;
    private DeviceMalfunctionHandler $deviceMalfunctionHandler;
    private TemperatureExceededHandler $temperatureExceededHandler;
    private DoorUnlockedHandler $doorUnlockedHandler;

    public function __construct(
        EventValidationService $validationService,
        DeviceMalfunctionHandler $deviceMalfunctionHandler,
        TemperatureExceededHandler $temperatureExceededHandler,
        DoorUnlockedHandler $doorUnlockedHandler
    ) {
        $this->validationService = $validationService;
        $this->deviceMalfunctionHandler = $deviceMalfunctionHandler;
        $this->temperatureExceededHandler = $temperatureExceededHandler;
        $this->doorUnlockedHandler = $doorUnlockedHandler;
    }

    #[Route('/api/event', name: 'api_event', methods: ['POST'])]
    public function event(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Walidacja deviceId & eventDate
        $violations = $this->validationService->validateBaseData($data);

        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            return $this->json([
                'message' => 'Validation failed',
                'errors' => $errors
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Walidacja reasonCode, reasonText, temp, treshold, unlockDate
        $specificViolations = $this->validationService->validateSpecificData($data);

        if (count($specificViolations) > 0) {
            $errors = [];
            foreach ($specificViolations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            return $this->json([
                'message' => 'Validation failed for specific fields',
                'errors' => $errors
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Obsługa zdarzeń na podstawie eventType
        $response = [];
        switch ($data['eventType']) {
            case 'deviceMalfunction':
                $response = $this->deviceMalfunctionHandler->handle($data);
                break;
        
            case 'temperatureExceeded':
                $response = $this->temperatureExceededHandler->handle($data);
                break;
        
            case 'doorUnlocked':
                $response = $this->doorUnlockedHandler->handle($data);
                break;
        }

        // Odpowiedź
            return $this->json([
                'message' => 'Request received and processed!',
                'receivedData' => $data,
                'details' => $response,
                
            ]);
    }
}
