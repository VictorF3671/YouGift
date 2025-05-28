<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "vendas")]
class Venda
{
    #[ORM\Id]
    #[ORM\Column(type: "string")]
    private string $id;

    #[ORM\Column(name: "usuario_id", type: "string")]
    private string $usuarioId;

    #[ORM\ManyToOne(targetEntity: GiftcardValue::class)]
    #[ORM\JoinColumn(name: "giftcard_value_id", referencedColumnName: "id")]
    private GiftcardValue $giftcardValue;

    #[ORM\Column(type: "float")]
    private float $valor;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    private DateTimeImmutable $criadoEm;

    #[ORM\OneToMany(mappedBy: "venda", targetEntity: GiftcardSerial::class)]
    private Collection $seriais;

    #[ORM\OneToOne(mappedBy: "venda", targetEntity: Pagamento::class)]
    private Pagamento $pagamento;
}
