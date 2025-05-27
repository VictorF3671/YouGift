<?php
namespace Core\UseCase\Giftcard\DTO;

class ComprarGiftcardOutputDto
{
    public function __construct(
        public string $vendaId,
        public string $codigoSerial
    ) {}
}
