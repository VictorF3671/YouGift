<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "giftcard_produtos")]
class GiftcardProduto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    public int $id;

    #[ORM\Column(type: "string")]
    public string $nome;

    #[ORM\Column(name: "logo_url", type: "string")]
    public string $logoUrl;

    #[ORM\Column(name: "descricao", type: "string")]
    public string $descricao;

    #[ORM\Column(name: "criado_em", type: "datetime_immutable")]
    public DateTimeImmutable $criadoEm;

    #[ORM\OneToMany(mappedBy: "giftcardProduto", targetEntity: GiftcardValue::class)]
    public Collection $valores;

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setLogoUrl(string $logo): void
    {
        $this->logoUrl = $logo;
    }

    public function setCriadoEm(DateTimeImmutable $data): void
    {
        $this->criadoEm = $data;
    }

     public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
}
