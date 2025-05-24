<?php

namespace Core\Domain\Usuario\Repository;

use Core\Domain\Usuario\Entity\Usuario;

interface IUsuarioRepository
{
    public function salvar(Usuario $usuario): Usuario;

    public function buscarPorId(int $id): ?Usuario;

    public function buscarPorUsername(string $username): ?Usuario;

    public function buscarPorEmail(string $email): ?Usuario;

    public function buscarPorCpf(string $cpf): ?Usuario;

    public function listarTodos(): array;

    public function remover(int $id): void;
}
