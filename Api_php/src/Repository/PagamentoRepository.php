<?php

namespace Infra\Repository;

use Core\Domain\Pagamento\Entity\Pagamento;
use Core\Domain\Pagamento\Repository\PagamentoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class PagamentoRepository implements PagamentoRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function save(Pagamento $pagamento): void
    {
        $this->em->persist($pagamento);
        $this->em->flush();
    }

    public function findById(string $id): Pagamento
    {
        return $this->em->getRepository(Pagamento::class)->find($id);
    }

    public function findByVendaId(string $vendaId): ?Pagamento
    {
        return $this->em->getRepository(Pagamento::class)->findOneBy(['venda' => $vendaId]);
    }
}
