<?php

namespace Core\UseCase\Usuario;

use Core\Domain\Usuario\Repository\IUsuarioRepository;
use DomainException;

class RemoverUsuario
{
    public function __construct(
        private IUsuarioRepository $usuarioRepository
    ) {}

    public function executar(int $id): void
    {
        $usuario = $this->usuarioRepository->buscarPorId($id);

        if (!$usuario) {
            throw new DomainException('Usuário não encontrado.');
        }

        $this->usuarioRepository->remover($id);
    }
}
