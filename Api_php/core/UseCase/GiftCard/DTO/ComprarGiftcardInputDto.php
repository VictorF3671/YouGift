<?php
namespace Core\Application\UseCase\ComprarGiftcard;

class ComprarGiftcardInputDto
{
    public function __construct(
        public string $usuarioId,
        public string $giftcardValueId
    ) {}
}
