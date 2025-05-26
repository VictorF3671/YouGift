<?php

namespace Core\Domain\GiftCard\Entity;

use DateTimeImmutable;

class GiftCardProduto
{
    public function __construct(
        private string $id,
        private string $nome,
        private string $logoUrl,
        private string $descricao,
        private DateTimeImmutable $criadoEm,
    ) {}

    public function getId(): string { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getLogoUrl(): string { return $this->logoUrl; }
    public function getDescricao(): string { return $this->descricao; }
    public function getCriadoEm(): DateTimeImmutable { return $this->criadoEm; }
}
