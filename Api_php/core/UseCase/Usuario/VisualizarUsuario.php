<?php

namespace Core\UseCase\Usuario;

use Core\Domain\Usuario\Entity\Usuario;
use Core\Domain\Usuario\Repository\IUsuarioRepository;
use DomainException;

class VisualizarUsuario
{
    public function __construct(
        private IUsuarioRepository $usuarioRepository
        ) 
    {}

    public function executar(int $id) : Usuario {
        $usuario = $this->usuarioRepository->buscarPorId($id);

        if(!$usuario)
        {
            throw new DomainException('Usuário não encontrado.');
        } 

        return $usuario;
    }
}