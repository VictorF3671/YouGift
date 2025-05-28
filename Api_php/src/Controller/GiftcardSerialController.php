<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/giftcard-seriais')]
class GiftcardSerialController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function listarTodos(): JsonResponse
    {
        return $this->json([]);
    }
}
