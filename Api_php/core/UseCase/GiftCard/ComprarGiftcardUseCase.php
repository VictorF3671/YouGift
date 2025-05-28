<?php
namespace Core\UseCase\GiftCard;

use Core\Domain\Pagamento\Entity\Pagamento;
use Core\Domain\Pagamento\Enum\StatusPagamento;
use Core\Domain\Pagamento\Repository\PagamentoRepositoryInterface;
use Core\UseCase\GiftCard\DTO\ComprarGiftcardOutputDto;
use Core\Domain\Venda\Entity\Venda;
use Core\Domain\GiftCard\Entity\GiftcardSerial;
use Core\Domain\GiftCard\Enum\StatusGiftcardSerial;
use Core\Domain\Venda\Repository\VendaRepositoryInterface;
use Core\Domain\GiftCard\Repository\GiftcardValueRepositoryInterface;
use Core\Domain\GiftCard\Repository\GiftcardSerialRepositoryInterface;
use Core\UseCase\GiftCard\DTO\ComprarGiftcardInputDto as DTOComprarGiftcardInputDto;
use Core\UseCase\GiftCard\DTO\ComprarGiftcardOutputDto as DTOComprarGiftcardOutputDto;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ComprarGiftcardUseCase
{
    public function __construct(
        private VendaRepositoryInterface $vendaRepository,
        private GiftcardValueRepositoryInterface $giftcardValueRepository,
        private GiftcardSerialRepositoryInterface $giftcardSerialRepository,
        private PagamentoRepositoryInterface $pagamentoRepository
    ) {}

    public function execute(DTOComprarGiftcardInputDto $input): DTOComprarGiftcardOutputDto
    {
        $valor = $this->giftcardValueRepository
            ->findById($input->giftcardValueId)
            ->getValor();

        $venda = new Venda(
            id: Uuid::uuid4()->toString(),
            usuarioId: $input->usuarioId,
            giftcardValueId: $input->giftcardValueId,
            valor: $valor,
            criadoEm: new DateTimeImmutable()
        );
        $this->vendaRepository->save($venda);

        $pagamento = new Pagamento(
            id: Uuid::uuid4()->toString(),
            vendaId: $venda->getId(),
            metodoPagamento: $input->metodoPagamento,
            cartaoId: $input->cartaoId,
            status: StatusPagamento::PENDENTE,
            criadoEm: new DateTimeImmutable()
        );
        $this->pagamentoRepository->save($pagamento);

        $codigoSerial = strtoupper(bin2hex(random_bytes(8)));

        $serial = new GiftcardSerial(
            id: Uuid::uuid4()->toString(),
            vendaId: $venda->getId(),
            giftcardValueId: $input->giftcardValueId,
            codigoSerial: $codigoSerial,
            geradoEm: new DateTimeImmutable(),
            status: StatusGiftcardSerial::ATIVO
        );
        $this->giftcardSerialRepository->save($serial);

        return new ComprarGiftcardOutputDto(
            vendaId: $venda->getId(),
            codigoSerial: $codigoSerial
        );
    }
}
