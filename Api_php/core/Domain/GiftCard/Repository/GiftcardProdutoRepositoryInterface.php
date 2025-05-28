<?php

namespace Core\Domain\GiftCard\Repository;

use Core\Domain\GiftCard\Entity\GiftCardProduto;

interface GiftcardProdutoRepositoryInterface{
    public function findById(string $id): ?GiftCardProduto;
    public function delete(GiftCardProduto $giftcard): void;    
}