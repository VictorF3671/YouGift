<?php

namespace Core\Domain\Pagamento\Repository;

use Core\Domain\Pagamento\Entity\Pagamento;

interface PagamentoRepositoryInterface
{

    public function save(Pagamento $pagamento): void;

    public function findById(string $id): Pagamento;

    public function findByVendaId(string $vendaId): ?Pagamento;
}
