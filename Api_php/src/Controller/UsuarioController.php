<?php

namespace App\Controller;

use Core\UseCase\Usuario\VisualizarUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UsuarioController extends AbstractController
{
    public function __construct(
        private VisualizarUsuario $visualizarUsuario
    ) {}

    #[Route('/visualizar/', name: 'visualizar_usuario', methods: ['GET'])]
    public function viewUser(Request $request): JsonResponse
    {
        $id = (int)$request->query->get('id');
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
