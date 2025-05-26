<?php

namespace Core\Domain\GiftCard\Repository;

use Core\Domain\Giftcard\Entity\GiftcardValue;

interface GiftcardValueRepositoryInterface
{
    public function findById(string $id): GiftcardValue;
}
