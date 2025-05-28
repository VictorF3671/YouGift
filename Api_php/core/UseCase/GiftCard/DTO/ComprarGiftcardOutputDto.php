<?php
namespace Core\UseCase\GiftCard\DTO;

class ComprarGiftcardOutputDto
{
    public function __construct(
        public string $vendaId,
        public string $codigoSerial
    ) {}
}
