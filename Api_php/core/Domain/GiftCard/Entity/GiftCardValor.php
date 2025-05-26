<?php
namespace Core\Domain\GiftCard\Entity;

use DateTimeImmutable;

class GiftcardValue
{
    public function __construct(
        private string $id,
        private string $produtoId,
        private float $valor,
        private DateTimeImmutable $criadoEm,
    ) {}

    public function getId(): string { return $this->id; }
    public function getProdutoId(): string { return $this->produtoId; }
    public function getValor(): float { return $this->valor; }
    public function getCriadoEm(): DateTimeImmutable { return $this->criadoEm; }
}
