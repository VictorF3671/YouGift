<?php

namespace App\Repository;

use App\Entity\Usuario;
use Core\Domain\Usuario\Entity\Usuario as UsuarioDomain;
use Core\Domain\Usuario\Enum\TipoUsuario;
use Core\Domain\Usuario\Repository\IUsuarioRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioRepository extends ServiceEntityRepository implements IUsuarioRepository
{

    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, Usuario::class);
        $this->em=$em;
    }

    public function salvar(UsuarioDomain $usuario): UsuarioDomain
    {
        $orm = new Usuario();
        $orm->cpf = $usuario->getCpf();
        $orm->nome = $usuario->getNome();
        $orm->nomeUsuario = $usuario->getNomeUsuario();
        $orm->email = $usuario->getEmail();
        $orm->telefone = $usuario->getTelefone();
        $orm->senha = $usuario->getSenha();
        $orm->tipo = $usuario->getTipo()->value;
        $orm->criadoEm = $usuario->getCriadoEm();

        $this->em->persist($orm);
        $this->em->flush();

        return $this->mapearParaDominio($orm);
    }

    public function buscarPorId(int $id): ?UsuarioDomain
    {
        $orm = $this->find($id);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }

    public function buscarPorEmail(string $email): ?UsuarioDomain
    {
        $orm = $this->findOneBy(['email' => $email]);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }

    public function buscarPorCpf(string $cpf): ?UsuarioDomain
    {
        $orm = $this->findOneBy(['cpf' => $cpf]);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }

    public function buscarPorUsername(string $username): ?UsuarioDomain
    {
        $orm = $this->findOneBy(['nomeUsuario' => $username]);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }


    public function listarTodos(): array
    {
        return array_map(
            [$this, 'mapearParaDominio'],
            $this->findAll()
        );
    }

    public function remover(int $id): void
    {
        $orm = $this->find($id);
        if ($orm) {
            $this->em->remove($orm);
            $this->em->flush();
        }
    }


    private function mapearParaDominio(Usuario $orm): UsuarioDomain
    {
        return new UsuarioDomain(
            id: $orm->id,
            cpf: $orm->cpf,
            nome: $orm->nome,
            nomeUsuario: $orm->nomeUsuario,
            email: $orm->email,
            telefone: $orm->telefone,
            senha: $orm->senha,
            tipo: TipoUsuario::fromInt($orm->tipo),
            criadoEm: $orm->criadoEm
        );
    }
}
