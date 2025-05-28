<?php

namespace App\Repository;

use Core\Domain\Giftcard\Entity\GiftcardValue;
use Core\Domain\Giftcard\Repository\GiftcardValueRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GiftcardValueRepository implements GiftcardValueRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findById(string $id): GiftcardValue
    {
        return $this->em->getRepository(GiftcardValue::class)->find($id);
    }

    public function findByProdutoId(string $produtoId): array
    {
        return $this->em->getRepository(GiftcardValue::class)
            ->findBy(['produto' => $produtoId]);
    }
}
