<?php
namespace Core\UseCase\Giftcard\DTO;

use Api_php\core\Domain\Pagamento\Enum\MetodoPagamento;

class ComprarGiftcardInputDto
{
    public function __construct(
        public string $usuarioId,
        public string $giftcardValueId,
        public MetodoPagamento $metodoPagamento,
        public ?string $cartaoId = null
    ) {}
}
