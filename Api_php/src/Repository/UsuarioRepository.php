<?php

namespace App\Repository;

use App\Entity\Usuario as EntityUsuario;
use Core\Domain\Usuario\Entity\Usuario;
use Core\Domain\Usuario\Enum\TipoUsuario;
use Core\Domain\Usuario\Repository\IUsuarioRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioRepository extends ServiceEntityRepository implements IUsuarioRepository
{

    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, EntityUsuario::class);
        $this->em = $em;
    }

    public function salvar(Usuario $usuario): Usuario
    {
        $orm = new EntityUsuario();
        $orm->cpf = $usuario->getCpf();
        $orm->nome = $usuario->getNome();
        $orm->email = $usuario->getEmail();
        $orm->telefone = $usuario->getTelefone();
        $orm->senha = $usuario->getSenha();
        $orm->tipo = $usuario->getTipo()->value;
        $orm->criadoEm = $usuario->getCriadoEm();

        $this->em->persist($orm);
        $this->em->flush();

        return $this->mapearParaDominio($orm);
    }

    public function buscarPorId(int $id): ?Usuario
    {
        $orm = $this->find($id);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }

    public function buscarPorEmail(string $email): ?Usuario
    {
        $orm = $this->findOneBy(['email' => $email]);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }

    public function buscarPorOrmEmail(string $email): ?EntityUsuario
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function buscarPorCpf(string $cpf): ?Usuario
    {
        $orm = $this->findOneBy(['cpf' => $cpf]);
        return $orm ? $this->mapearParaDominio($orm) : null;
    }

    public function listarTodos(): array
    {
        return array_map(
            fn($usuario) => $this->mapearParaDominio($usuario),
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


    private function mapearParaDominio(EntityUsuario $orm): Usuario
    {
        return new Usuario(
            id: $orm->id,
            cpf: $orm->cpf,
            nome: $orm->nome,
            email: $orm->email,
            telefone: $orm->telefone,
            senha: $orm->senha,
            tipo: TipoUsuario::fromInt($orm->tipo),
            criadoEm: $orm->criadoEm
        );
    }
}
