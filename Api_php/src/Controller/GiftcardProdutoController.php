<?php

namespace App\Controller;

use App\Entity\GiftcardProduto;
use App\Repository\GiftcardProdutoRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/giftcard-produtos')]
class GiftcardProdutoController extends AbstractController
{
    #[Route('/giftcards', methods: ['GET'])]
    public function listarTodos(GiftcardProdutoRepository $repository): JsonResponse
    {
        $produtos = $repository->findAll();
        return $this->json($produtos);
    }

    #[Route('/giftcard/{id}', methods: ['GET'])]
    public function buscarPorId(string $id, GiftcardProdutoRepository $repository): JsonResponse
    {
        $produto = $repository->find($id);

        if (!$produto) {
            return $this->json(['erro' => 'Giftcard não encontrado'], 404);
        }

        return $this->json($produto);
    }

    #[Route('/criar-giftcard', methods: ['POST'])]
    public function criar(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $dados = json_decode($request->getContent(), true);

        $giftcard = new GiftcardProduto();
        $giftcard->setNome($dados['nome']);
        $giftcard->setLogoUrl($dados['logoUrl']);
        $giftcard->setDescricao($dados['descricao']);
        $giftcard->setCriadoEm(new DateTimeImmutable());

        $em->persist($giftcard);
        $em->flush();

        return $this->json(['mensagem' => 'Giftcard criado com sucesso'], 201);
    }
}
