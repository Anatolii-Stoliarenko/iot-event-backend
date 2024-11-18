<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api/event', name: 'api_event', methods: ['POST'])]
    public function test(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Przykładowa odpowiedź
        return $this->json([
            'message' => 'Request received!',
            'receivedData' => $data
        ]);
    }
}
