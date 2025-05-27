<?php

namespace Core\UseCase\Usuario;

use Core\Domain\Usuario\Entity\Usuario;
use Core\Domain\Usuario\Enum\TipoUsuario;
use Core\Domain\Usuario\Repository\IUsuarioRepository;
use DomainException;

class AtualizarUsuario
{
    public function __construct(
        private IUsuarioRepository $usuarioRepository
    ) {}

    public function executar(array $dados): Usuario
    {
        $usuario = $this->usuarioRepository->buscarPorId($dados['id'] ?? 0);

        if (!$usuario) {
            throw new DomainException('Usuário não encontrado.');
        }

        if (isset($dados['nome'])) {
            $usuario->setNome($dados['nome']);
        }

        if (isset($dados['email'])) {
            $usuario->setEmail($dados['email']);
        }

        if (isset($dados['telefone'])) {
            $usuario->setTelefone($dados['telefone']);
        }

        if (isset($dados['cpf'])) {
            $usuario->setCpf($dados['cpf']);
        }

        if (isset($dados['tipo']) && TipoUsuario::tryFrom($dados['tipo'])) {
            $usuario->setTipo(TipoUsuario::from($dados['tipo']));
        }
        return $this->usuarioRepository->salvar($usuario);
    }
}
