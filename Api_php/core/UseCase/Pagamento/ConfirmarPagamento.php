<?php
namespace Core\UseCase\Pagamento;

use Api_php\core\Domain\Pagamento\Enum\StatusPagamento;
use Api_php\core\Domain\Pagamento\Repository\PagamentoRepositoryInterface;
use Core\Domain\GiftCard\Entity\GiftcardSerial;
use Core\Domain\GiftCard\Enum\StatusGiftcardSerial;
use Core\Domain\GiftCard\Repository\GiftcardSerialRepositoryInterface;
use Core\Domain\Venda\Repository\VendaRepositoryInterface;
use Core\UseCase\Pagamento\DTO\ConfirmarPagamentoInputDto;
use Core\UseCase\Pagamento\DTO\ConfirmarPagamentoOutputDto;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ConfirmarPagamentoUseCase
{
    public function __construct(
        private PagamentoRepositoryInterface $pagamentoRepository,
        private GiftcardSerialRepositoryInterface $serialRepository,
        private VendaRepositoryInterface $vendaRepository,
    ) {}

    public function execute(ConfirmarPagamentoInputDto $input): ConfirmarPagamentoOutputDto
    {
        $pagamento = $this->pagamentoRepository->findById($input->pagamentoId);

        if ($pagamento->getStatus() === StatusPagamento::APROVADO) {
            return new ConfirmarPagamentoOutputDto('CONFIRMADO', 'Pagamento já confirmado');
        }

         $this->pagamentoRepository->updateStatus($input->pagamentoId, StatusPagamento::APROVADO->value);
         $serial = $this->serialRepository->findByVendaId($pagamento->getVendaId());

         if (!$serial) {
            $venda = $this->vendaRepository->findById($pagamento->getVendaId());

            $codigoSerial = strtoupper(bin2hex(random_bytes(8)));

            $novoSerial = new GiftcardSerial(
                id: Uuid::uuid4()->toString(),
                vendaId: $venda->getId(),
                giftcardValueId: $venda->getGiftcardValueId(),
                codigoSerial: $codigoSerial,
                geradoEm: new DateTimeImmutable(),
                status: StatusGiftcardSerial::ATIVO
            );
            $this->serialRepository->save($novoSerial);
        }

        return new ConfirmarPagamentoOutputDto('CONFIRMADO', "Pagamento confirmado e serial garantido");
    }
}