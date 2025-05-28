<?php

namespace Core\UseCase\Usuario\DTO;

class LoginOutputDto {
    public function __construct(
        public string $token,
        public string $nome,
        public string $email,
        public string $role
    ) {}
}