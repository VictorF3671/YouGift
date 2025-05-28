<?php

namespace App\Controller;

use Core\Domain\Pagamento\Enum\MetodoPagamento;
use Core\Domain\UseCase\Vendas\DTO\ListarComprasDoUsuarioInputDto;
use Core\Domain\UseCase\Vendas\ListarComprasDoUsuario;
use Core\UseCase\GiftCard\ComprarGiftcardUseCase;
use Core\UseCase\GiftCard\DTO\ComprarGiftcardInputDto;
use Core\UseCase\GiftcardProduto\DeletarGiftcardProdutoUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/vendas')]
class VendaController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function listarTodas(): JsonResponse
    {
        return $this->json([]);
    }
    #[Route('/usuario/{usuarioId}', methods: ['GET'])]
    public function listarPorUsuario(
        string $usuarioId,
        ListarComprasDoUsuario $useCase
    ): JsonResponse {
        $inputDto = new ListarComprasDoUsuarioInputDto($usuarioId);

        $compras = $useCase->execute($inputDto);

        return $this->json($compras);
    }

    #[Route('', methods: ['POST'])]
    public function comprar(
        Request $request,
        ComprarGiftcardUseCase $useCase
    ): JsonResponse {
        $dados = json_decode($request->getContent(), true);

        $inputDto = new ComprarGiftcardInputDto(
            $dados['usuarioId'],
            $dados['giftcardValueId'],
            MetodoPagamento::from($dados['metodoPagamento']),
            $dados['cartaoId'] ?? null
        );

        $output = $useCase->execute($inputDto);

        return $this->json([
            'vendaId' => $output->vendaId,
            'codigoSerial' => $output->codigoSerial
        ]);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function deletar(
        string $id,
        DeletarGiftcardProdutoUseCase $useCase
    ): JsonResponse {
        try {
            $useCase->execute($id);
            return $this->json(['mensagem' => 'Giftcard removido com sucesso.'], Response::HTTP_NO_CONTENT);
        } catch (\DomainException $e) {
            return $this->json(['erro' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return $this->json(['erro' => 'Erro interno.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
