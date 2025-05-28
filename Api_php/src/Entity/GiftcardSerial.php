<?php

namespace App\Entity;

use Core\Domain\GiftCard\Enum\StatusGiftcardSerial;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "giftcard_seriais")]
class GiftcardSerial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Venda::class, inversedBy: "seriais")]
    #[ORM\JoinColumn(name: "venda_id", referencedColumnName: "id")]
    private Venda $venda;

    #[ORM\ManyToOne(targetEntity: GiftcardValue::class)]
    #[ORM\JoinColumn(name: "giftcard_value_id", referencedColumnName: "id")]
    private GiftcardValue $giftcardValue;

    #[ORM\Column(name: "codigo_serial", type: "string", unique: true)]
    private string $codigoSerial;

    #[ORM\Column(name: "gerado_em", type: "datetime_immutable")]
    private DateTimeImmutable $geradoEm;

    #[ORM\Column(type: "string", enumType: StatusGiftcardSerial::class)]
    private StatusGiftcardSerial $status;

    
}
