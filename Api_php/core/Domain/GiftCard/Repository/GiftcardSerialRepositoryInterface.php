<?php

namespace Core\Domain\GiftCard\Repository;

use Core\Domain\Giftcard\Entity\GiftcardSerial;

interface GiftcardSerialRepositoryInterface
{
    public function save(GiftcardSerial $serial): void;

    public function findByVendaId(string $vendaId): GiftcardSerial;

    public function findWithProdutoNomeByVendaId(string $vendaId): array;
}