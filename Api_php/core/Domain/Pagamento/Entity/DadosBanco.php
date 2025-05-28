<?php
namespace Core\Domain\Pagamento\Entity;

use DateTimeImmutable;

class DadosBanco{
    public function __construct(
        private string $id,
        private string $usuarioId,
        private string $numero_cartao,
        private string $nome_cartao,
        private string $validade,
        private string $cvv,
        private DateTimeImmutable $criadoEm = new DateTimeImmutable()
    ) {}


    public function getId(): string
    {
        return $this->id;
    }
    public function getUsuarioId(): string
    {
        return $this->usuarioId;
    }
    public function getNumeroCartao(): string
    {
        return $this->numero_cartao;
    }
    public function getNomeCartao(): string
    {
        return $this->nome_cartao;
    }
    public function getValidade(): string
    {
        return $this->validade;
    }
    public function getCvv(): string
    {
        return $this->cvv;
    }
    public function getCriadoEm(): DateTimeImmutable
    {
        return $this->criadoEm;
    }
}