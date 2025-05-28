<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "dados_banco")]
class DadosBanco
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(name: "usuario_id", type: "string")]
    private string $usuarioId;

    #[ORM\Column(name: "numero_cartao", type: "string")]
    private string $numeroCartao;

    #[ORM\Column(name: "nome_titular", type: "string")]
    private string $nomeTitular;

    #[ORM\Column(name: "validade", type: "string")]
    private string $validade;

    #[ORM\Column(name: "cvv", type: "string")]
    private string $cvv;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    private DateTimeImmutable $criadoEm;
}
