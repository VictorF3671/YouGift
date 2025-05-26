<?php
namespace Core\Application\UseCase\ComprarGiftcard;

class ComprarGiftcardOutputDto
{
    public function __construct(
        public string $vendaId,
        public string $codigoSerial
    ) {}
}
