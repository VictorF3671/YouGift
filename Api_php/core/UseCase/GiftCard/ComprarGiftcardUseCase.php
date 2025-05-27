<?php
namespace Core\UseCase\Giftcard\ComprarGiftcard;

use Core\Application\UseCase\ComprarGiftcard\ComprarGiftcardInputDto;
use Core\Application\UseCase\ComprarGiftcard\ComprarGiftcardOutputDto;
use Core\Domain\Venda\Entity\Venda;
use Core\Domain\Giftcard\Entity\GiftcardSerial;
use Core\Domain\Giftcard\Enum\StatusGiftcardSerial;
use Core\Domain\Venda\Repository\VendaRepositoryInterface;
use Core\Domain\Giftcard\Repository\GiftcardValueRepositoryInterface;
use Core\Domain\Giftcard\Repository\GiftcardSerialRepositoryInterface;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ComprarGiftcardUseCase
{
    public function __construct(
        private VendaRepositoryInterface $vendaRepository,
        private GiftcardValueRepositoryInterface $giftcardValueRepository,
        private GiftcardSerialRepositoryInterface $giftcardSerialRepository
    ) {}

    public function execute(ComprarGiftcardInputDto $input): ComprarGiftcardOutputDto
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
