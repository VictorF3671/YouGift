<?php

namespace App\Repository;

use App\Entity\Usuario as EntityUsuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthUsuarioRepository extends ServiceEntityRepository implements UserProviderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntityUsuario::class);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->findOneBy(['email' => $identifier]);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof \App\Entity\Usuario) {
            throw new UnsupportedUserException();
        }

        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === \App\Entity\Usuario::class;
    }

}