<?php

namespace App\Infra;

use App\Entity\Usuario;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class JwtTokenService
{
    public function __construct(
        private JWTTokenManagerInterface $jwtManager
    ) {}

    public function gerarToken(Usuario $usuario): string
    {
        return $this->jwtManager->create($usuario);
    }
}
