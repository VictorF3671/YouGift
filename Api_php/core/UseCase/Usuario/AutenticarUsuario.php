<?php

namespace Core\UseCase\Usuario;

use App\Infra\JwtTokenService;
use Core\Domain\Usuario\Repository\IUsuarioRepository;
use Core\UseCase\Usuario\DTO\LoginInputDto;
use Exception;

class AutenticarUsuario
{
    public function __construct(
        private IUsuarioRepository $usuarioRepository,
        private JwtTokenService $jwtService
    ) {}

    public function executar(LoginInputDto $input): string
    {
        $usuario = $this->usuarioRepository->buscarPorOrmEmail($input->email);
        if (!$usuario || !password_verify($input->senha, $usuario->getPassword())) {
            throw new Exception("Credenciais inválidas.");
        }

        return $this->jwtService->gerarToken($usuario);
    }
}
