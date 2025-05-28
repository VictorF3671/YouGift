<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "giftcard_values")]
class GiftcardValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: GiftcardProduto::class, inversedBy: "valores")]
    #[ORM\JoinColumn(name: "giftcard_produto_id", referencedColumnName: "id")]
    private GiftcardProduto $giftcardProduto;

    #[ORM\Column(type: "float")]
    private float $valor;

    #[ORM\Column(type: "string")]
    private string $descricao;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    private DateTimeImmutable $criadoEm;
}
