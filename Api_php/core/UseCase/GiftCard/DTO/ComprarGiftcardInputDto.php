<?php
namespace Core\UseCase\GiftCard\DTO;

use Core\Domain\Pagamento\Enum\MetodoPagamento;

class ComprarGiftcardInputDto
{
    public function __construct(
        public string $usuarioId,
        public string $giftcardValueId,
        public MetodoPagamento $metodoPagamento,
        public ?string $cartaoId = null
    ) {}
}

