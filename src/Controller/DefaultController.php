<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response('IoT Backend is working!');
    }
}