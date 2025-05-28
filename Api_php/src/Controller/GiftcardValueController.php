<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/giftcard-valores')]
class GiftcardValueController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function listarPorProdutoId(): JsonResponse
    {
        return $this->json([]);
    }

    #[Route('', methods: ['POST'])]
    public function criar(): JsonResponse
    {
        return $this->json(['mensagem' => 'Valor cadastrado com sucesso'], 201);
    }
}
