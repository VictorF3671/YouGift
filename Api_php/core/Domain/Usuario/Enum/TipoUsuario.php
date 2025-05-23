<?php

namespace Core\Domain\Usuario\Enum;

enum TipoUsuario: int{
    case CLIENTE = 0;
    case ADMIN = 1;

    public function toString(): string
    {
        return match ($this){
            self::CLIENTE => 'cliente',
            self::ADMIN => 'admin',
        };
    }

    public static function fromInt(int $value): self
    {
        return match ($value){
            0 => self::CLIENTE,
            1 => self::ADMIN,
            default => throw new \InvalidArgumentException("Tipo de Usuário Inválido: $value"),
        };
    }
}