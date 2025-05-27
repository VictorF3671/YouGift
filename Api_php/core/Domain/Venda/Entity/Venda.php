<?php
namespace Core\Domain\Venda\Entity;

use DateTimeImmutable;

class Venda
{
    public function __construct(
        private string $id,
        private string $usuarioId,
        private string $giftcardValueId,
        private float $valor,
        private DateTimeImmutable $criadoEm,
    ) {}

    public function getId(): string { return $this->id; }
    public function getUsuarioId(): string { return $this->usuarioId; }
    public function getGiftcardValueId(): string { return $this->giftcardValueId; }
    public function getValor(): float { return $this->valor; }
    public function getCriadoEm(): DateTimeImmutable { return $this->criadoEm; }
}
