<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/dados-banco')]
class DadosBancoController extends AbstractController
{
    #[Route('', methods: ['POST'])]
    public function cadastrar(): JsonResponse
    {
        return $this->json(['mensagem' => 'Dados bancários salvos'], 201);
    }

    #[Route('/{usuarioId}', methods: ['GET'])]
    public function buscarPorUsuario(string $usuarioId): JsonResponse
    {
        return $this->json([]);
    }
}
