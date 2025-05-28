<?php
namespace App\Controller;

use App\Entity\GiftcardValue;
use App\Repository\GiftcardProdutoRepository;
use App\Repository\GiftcardValueRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/giftcard-valores')]
class GiftcardValueController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function listarPorProdutoId(Request $request, GiftcardValueRepository $repository): JsonResponse
    {
        $produtoId = $request->query->get('produtoId');

        if (!$produtoId) {
            return $this->json(['erro' => 'Parâmetro produtoId é obrigatório'], 400);
        }

        $valores = $repository->findByProdutoId($produtoId);

        return $this->json($valores);
    }

    #[Route('', methods: ['POST'])]
    public function criar(Request $request, GiftcardProdutoRepository $produtoRepo, EntityManagerInterface $em): JsonResponse
    {
        $dados = json_decode($request->getContent(), true);

        $produto = $produtoRepo->find($dados['produtoId']);

        if (!$produto) {
            return $this->json(['erro' => 'Produto não encontrado'], 404);
        }

        $valor = new GiftcardValue();
        $valor->giftcardProduto->$produto;
        $valor->setValor($dados['valor']);
        $valor->setCriadoEm(new DateTimeImmutable());

        $em->persist($valor);
        $em->flush();

        return $this->json(['mensagem' => 'Valor cadastrado com sucesso'], 201);
    }
}
