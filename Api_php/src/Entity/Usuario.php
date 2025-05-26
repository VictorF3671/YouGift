<?php

namespace App\Entity;

use Core\Domain\Usuario\Enum\TipoUsuario;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "usuarios")]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    public ?int $id = null;

    #[ORM\Column(type: "string", length: 11, unique: true)]
    public string $cpf;

    #[ORM\Column(type: "string")]
    public string $nome;

    #[ORM\Column(type: "string", unique: true)]
    public string $email;

    #[ORM\Column(type: "string", length: 11, nullable: true)]
    public ?string $telefone;

    #[ORM\Column(type: "string")]
    public string $senha;

    #[ORM\Column(type: "integer")]
    public int $tipo;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    public DateTimeImmutable $criadoEm;

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->senha;
    }
    public function getRoles(): array
    {
        $tipoEnum = TipoUsuario::from($this->tipo);

        return match ($tipoEnum) {
            TipoUsuario::ADMIN => ['ROLE_ADMIN'],
            default => ['ROLE_USER']
        };
    }
    public function eraseCredentials(): void {}
}
