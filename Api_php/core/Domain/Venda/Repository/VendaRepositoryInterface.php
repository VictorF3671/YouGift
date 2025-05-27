<?php

namespace Core\Domain\Venda\Repository;

use Core\Domain\Venda\Entity\Venda;

interface VendaRepositoryInterface
{
    public function save(Venda $venda): void;
    public function findByUsuarioId(string $usuarioId): array;
    public function findById(string $id): Venda;
}
