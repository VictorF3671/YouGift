<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "usuarios")]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    public ?int $id = null;

    #[ORM\Column(type: "string", length: 14, unique: true)]
    public string $cpf;

    #[ORM\Column(type: "string")]
    public string $nome;

    #[ORM\Column(name: "nome_usuario", type: "string", unique: true)]
    public string $nomeUsuario;

    #[ORM\Column(type: "string", unique: true)]
    public string $email;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $telefone;

    #[ORM\Column(type: "string")]
    public string $senha;

    #[ORM\Column(type: "integer")]
    public int $tipo;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    public \DateTimeImmutable $criadoEm;
}
