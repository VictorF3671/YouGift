<?php

namespace Core\Domain\GiftCard\Enum;

enum StatusGiftcardSerial: int
{
    case ATIVO = 0;
    case USADO = 1;

    public function toString(): string
    {
        return match ($this) {
            self::ATIVO => 'ativo',
            self::USADO => 'usado',
        };
    }

    public static function fromInt(int $value): self
    {
        return match ($value) {
            0 => self::ATIVO,
            1 => self::USADO,
            default => throw new \InvalidArgumentException("Status inválido para GiftcardSerial: $value"),
        };
    }
}
