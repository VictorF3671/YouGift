<?php

namespace App\Controller;

use Core\UseCase\Usuario\RegistrarUsuario;
use Core\UseCase\Usuario\VisualizarUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UsuarioController extends AbstractController
{
    public function __construct(
        private RegistrarUsuario $registrarUsuario,
        private VisualizarUsuario $visualizarUsuario
    ) {}

    #[Route('/registrar-usuario', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $dados = json_decode($request->getContent(), true);

        try {
            $usuario = $this->registrarUsuario->executar($dados);

            return new JsonResponse([
                'Cliente criado com sucesso',
                'id' => $usuario->getId(),
                'nome' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'cpf' => $usuario->getCpf(),
                'grupo' => $usuario->getTipo()->toString(),
                'criado_em' => $usuario->getCriadoEm()->format('Y-m-d H:i:s'),
            ], JsonResponse::HTTP_CREATED);
        } catch (\DomainException $e) {
            return new JsonResponse([
                'erro' => 'Erro inesperado: ' . $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

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
