<?php

namespace Api_php\core\Domain\Pagamento\Enum;

enum MetodoPagamento: int
{
    case CARTAO = 0;
    case PIX = 1;

    public function toString(): string
    {
        return match ($this) {
            self::CARTAO => 'cartão',
            self::PIX => 'pix',
        };
    }

    public static function fromInt(int $value): self
    {
        return match ($value) {
            0 => self::CARTAO,
            1 => self::PIX,
            default => throw new \InvalidArgumentException("Método de Pagamento Inválido: $value"),
        };
    }
}

enum StatusPagamento: int
{
    case PENDENTE = 0;
    case APROVADO = 1;

    public function toString(): string
    {
        return match ($this) {
            self::PENDENTE => 'pendente',
            self::APROVADO => 'aprovado',
        };
    }

    public static function fromInt(int $value): self
    {
        return match ($value) {
            0 => self::PENDENTE,
            1 => self::APROVADO,
            default => throw new \InvalidArgumentException("Status de Pagamento Inválido: $value"),
        };
    }
}
