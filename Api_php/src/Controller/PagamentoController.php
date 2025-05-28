<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/pagamentos')]
class PagamentoController extends AbstractController
{
    #[Route('', methods: ['POST'])]
    public function criar(): JsonResponse
    {
        return $this->json(['mensagem' => 'Pagamento confirmado'], 201);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function buscarPorId(string $id): JsonResponse
    {
        return $this->json([]);
    }
}
