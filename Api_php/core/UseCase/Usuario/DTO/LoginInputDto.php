<?php
namespace Core\UseCase\Usuario\DTO;

class LoginInputDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $senha,
    ) {}
}

