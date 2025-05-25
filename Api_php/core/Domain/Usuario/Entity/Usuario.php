<?php

namespace Core\Domain\Usuario\Entity;

use Core\Domain\Usuario\Enum\TipoUsuario;
use Symfony\Component\Security\Core\User\UserInterface;

class Usuario
{
    public function __construct(
        private ?int $id,
        private string $cpf,
        private string $nome,
        private string $nomeUsuario,
        private string $email,
        private string $telefone,
        private string $senha,
        private TipoUsuario $tipo,
        private \DateTimeImmutable $criadoEm = new \DateTimeImmutable()
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getNomeUsuario(): string
    {
        return $this->nomeUsuario;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getTipo(): TipoUsuario
    {
        return $this->tipo;
    }

    public function getCriadoEm(): \DateTimeImmutable
    {
        return $this->criadoEm;
    }
}
