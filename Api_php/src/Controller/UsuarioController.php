<?php

namespace App\Controller;

use Core\UseCase\Usuario\VisualizarUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UsuarioController extends AbstractController
{
    public function __construct(
        private VisualizarUsuario $visualizarUsuario
    ) {}

    #[Route('/visualizar/{id}', name: 'visualizar_usuario', methods: ['GET'])]
    public function viewUser(string $id): JsonResponse
    {
        $id = (int)$id;
        $usuario = $this->visualizarUsuario->executar($id);

        return new JsonResponse([
            'id' => $usuario->getId(),
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'cpf' => $usuario->getCpf(),
            'grupo' => $usuario->getTipo()->toString(),
            'criado_em' => $usuario->getCriadoEm()->format('Y-m-d H:i:s'),
        ]);
    }
}
