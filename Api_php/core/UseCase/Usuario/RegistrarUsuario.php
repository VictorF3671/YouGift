<?php

namespace Core\UseCase\Usuario;

use Core\Domain\Usuario\Entity\Usuario;
use Core\Domain\Usuario\Enum\TipoUsuario;
use Core\Domain\Usuario\Repository\IUsuarioRepository;

class RegistrarUsuario
{
    public function __construct(
        private IUsuarioRepository $usuarioRepository
    ) {}

    public function executar(array $dados): Usuario
    {
        $cpf = $dados['cpf'];
        $email = $dados['email'];
        $nomeUsuario = $dados['nome_usuario'];
        
        if ($this->usuarioRepository->buscarPorCpf($cpf)) {
            throw new \DomainException("CPF já está em uso.");
        }

        if ($this->usuarioRepository->buscarPorEmail($email)) {
            throw new \DomainException("Email já está em uso.");
        }
        
        $senhaHash = password_hash($dados['senha'], PASSWORD_BCRYPT);

        $usuario = new Usuario(
            id: null,
            cpf: $cpf,
            nome: $dados['nome'],
            nomeUsuario: $nomeUsuario,
            email: $email,
            telefone: $dados['telefone'] ?? '',
            senha: $senhaHash,
            tipo: TipoUsuario::CLIENTE, 
        );

        return $this->usuarioRepository->salvar($usuario);
    }

}