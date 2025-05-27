<?php
namespace Api_php\core\Domain\Pagamento\Entity;

use Api_php\core\Domain\Pagamento\Enum\MetodoPagamento;
use Api_php\core\Domain\Pagamento\Enum\StatusPagamento;
use DateTimeImmutable;

class Pagamento
{
    public function __construct(
        private ?int $id,
        private string $vendaId,
        private MetodoPagamento $metodoPagamento,
        private ?string $cartaoId = null,
        private ?string $idExterno = null,
        private StatusPagamento $status,
        private DateTimeImmutable $criadoEm = new DateTimeImmutable(),
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getVendaId(): string
    {
        return $this->vendaId;
    }
    public function getMetodoPagamento(): MetodoPagamento
    {
        return $this->metodoPagamento;
    }
    public function getCartaoId(): ?string
    {
        return $this->cartaoId;
    }
    public function getStatus(): StatusPagamento
    {
        return $this->status;
    }
    public function getCriadoEm(): DateTimeImmutable
    {
        return $this->criadoEm;
    }
}