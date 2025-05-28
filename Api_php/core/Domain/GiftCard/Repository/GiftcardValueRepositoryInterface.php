<?php

namespace Core\Domain\GiftCard\Repository;

use Core\Domain\GiftCard\Entity\GiftcardValue;

interface GiftcardValueRepositoryInterface
{
    public function findById(string $id): GiftcardValue;
}
