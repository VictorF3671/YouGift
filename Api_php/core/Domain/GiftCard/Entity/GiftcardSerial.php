<?php

namespace Core\Domain\GiftCard\Entity;

use Core\Domain\Giftcard\Enum\StatusGiftcardSerial;
use DateTimeImmutable;

class GiftcardSerial
{
    public function __construct(
        private string $id,
        private string $vendaId,
        private string $giftcardValueId,
        private string $codigoSerial,
        private DateTimeImmutable $geradoEm,
        private StatusGiftcardSerial $status,
        private ?string $nomeProduto = null
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getVendaId(): string
    {
        return $this->vendaId;
    }

    public function getGiftcardValueId(): string
    {
        return $this->giftcardValueId;
    }

    public function getCodigoSerial(): string
    {
        return $this->codigoSerial;
    }

    public function getGeradoEm(): DateTimeImmutable
    {
        return $this->geradoEm;
    }

    public function getStatus(): StatusGiftcardSerial
    {
        return $this->status;
    }

    public function marcarComoUsado(): void
    {
        $this->status = StatusGiftcardSerial::USADO;
    }

    public function getNomeProduto(): ?string
    {
        return $this->nomeProduto;
    }
    
    public function setNomeProduto(string $nomeProduto): void
    {
        $this->nomeProduto = $nomeProduto;
    }
}
