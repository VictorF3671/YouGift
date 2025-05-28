<?php

namespace Infra\Repository;

use Core\Domain\GiftCard\Entity\GiftcardSerial;
use Core\Domain\GiftCard\Repository\GiftcardSerialRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GiftcardSerialRepository implements GiftcardSerialRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function save(GiftcardSerial $serial): void
    {
        $this->em->persist($serial);
        $this->em->flush();
    }

    public function findByVendaId(string $vendaId): ?GiftcardSerial
    {
        return $this->em->getRepository(GiftcardSerial::class)->findOneBy(['venda' => $vendaId]);
    }

    public function findWithProdutoNomeByVendaId(string $vendaId): ?array
    {
        $dql = "
        SELECT 
            s.codigoSerial,
            s.status,
            v.valor,
            p.nome AS nomeProduto
        FROM Core\Domain\Giftcard\Entity\GiftcardSerial s
        JOIN s.giftcardValue gv
        JOIN gv.giftcardProduto p
        JOIN s.venda ve
        WHERE ve.id = :vendaId
    ";

        return $this->em->createQuery($dql)
            ->setParameter('vendaId', $vendaId)
            ->getOneOrNullResult();
    }
}
