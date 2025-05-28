<?php
namespace Infra\Repository;

use Core\Domain\Venda\Entity\Venda;
use Core\Domain\Venda\Repository\VendaRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class VendaRepository implements VendaRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function save(Venda $venda): void
    {
        $this->em->persist($venda);
        $this->em->flush();
    }

    public function findById(string $id): Venda
    {
        return $this->em->getRepository(Venda::class)->find($id);
    }

    public function findAllByUsuarioId(string $usuarioId): array
    {
        return $this->em->getRepository(Venda::class)->findBy(['usuarioId' => $usuarioId]);
    }
}
