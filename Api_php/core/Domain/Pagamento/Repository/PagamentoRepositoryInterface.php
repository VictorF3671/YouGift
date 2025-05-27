<?php

namespace Api_php\core\Domain\Pagamento\Repository;

use Api_php\core\Domain\Pagamento\Entity\Pagamento;

interface PagamentoRepositoryInterface
{

    public function save(Pagamento $pagamento): void;

    public function findById(string $id): Pagamento;

    public function updateStatus(string $pagamentoId, string $novoStatus): void;

    public function findByVendaId(string $vendaId): ?Pagamento;
}
