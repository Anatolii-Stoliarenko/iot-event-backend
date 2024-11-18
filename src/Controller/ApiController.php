<?php

namespace App\Controller;

use App\Service\EventValidationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    private EventValidationService $validationService;

    public function __construct(EventValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    #[Route('/api/event', name: 'api_event', methods: ['POST'])]
    public function event(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Walidacja podstawowa
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

        // Walidacja specyficzna
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

        // Jeśli wszystko jest poprawne
        return $this->json([
            'message' => 'Request received and validated!',
            'receivedData' => $data
        ]);
    }
}
