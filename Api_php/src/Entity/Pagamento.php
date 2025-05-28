<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Domain\Pagamento\Enum\MetodoPagamento;
use Core\Domain\Pagamento\Enum\StatusPagamento;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: "pagamentos")]
class Pagamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\OneToOne(targetEntity: Venda::class)]
    #[ORM\JoinColumn(name: "venda_id", referencedColumnName: "id")]
    private Venda $venda;

    #[ORM\Column(type: "string", enumType: MetodoPagamento::class)]
    private MetodoPagamento $metodoPagamento;

    #[ORM\Column(name: "cartao_id", type: "string", nullable: true)]
    private ?string $cartaoId;

    #[ORM\Column(name: "id_externo", type: "string", nullable: true)]
    private ?string $idExterno;

    #[ORM\Column(type: "string", enumType: StatusPagamento::class)]
    private StatusPagamento $status;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    private DateTimeImmutable $criadoEm;
}
