<?php

namespace Core\UseCase\Usuario;

use App\Infra\JwtTokenService;
use App\Repository\AuthUsuarioRepository;
use App\Repository\UsuarioRepository;
use Core\UseCase\Usuario\DTO\LoginInputDto;
use Exception;

class AutenticarUsuario
{
    public function __construct(
        private AuthUsuarioRepository $usuarioRepositoryOrm,
        private JwtTokenService $jwtService
    ) {}

    public function executar(LoginInputDto $input): string
    {
        $usuarioOrm = $this->usuarioRepositoryOrm->loadUserByIdentifier($input->email);

        if (!$usuarioOrm) {
            throw new Exception("Usuário não encontrado.");
        }

        return $this->jwtService->gerarToken($usuarioOrm);
    }
}
