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
    public int $id;

    #[ORM\ManyToOne(targetEntity: GiftcardProduto::class, inversedBy: "valores")]
    #[ORM\JoinColumn(name: "giftcard_produto_id", referencedColumnName: "id")]
    public GiftcardProduto $giftcardProduto;

    #[ORM\Column(type: "float")]
    public float $valor;

    #[ORM\Column(type: "string")]
    public string $descricao;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    public DateTimeImmutable $criadoEm;

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }
    public function setCriadoEm(DateTimeImmutable $data): void
    {
        $this->criadoEm = $data;
    }
}
