<?php

namespace App\Controller;

use Core\Domain\Usuario\Repository\IUsuarioRepository;
use Core\UseCase\Usuario\AtualizarUsuario;
use Core\UseCase\Usuario\RemoverUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/usuario')]
class UsuarioController extends AbstractController
{
    public function __construct(
        private AtualizarUsuario $atualizarUsuario,
        private RemoverUsuario $removerUsuario,
        private IUsuarioRepository $usuarioRepository
    ) {}

    #[Route('/listar', name: 'visualizar_usuario', methods: ['GET'])]
    public function viewUser(Request $request, IUsuarioRepository $repo): JsonResponse
    {
        $id = (int) $request->query->get('id');
        $usuario = $repo->buscarPorId($id);

        if (!$usuario) {
            return new JsonResponse(['erro' => 'Usuário não encontrado'], 404);
        }

        return new JsonResponse([
            'id' => $usuario->getId(),
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'cpf' => $usuario->getCpf(),
            'grupo' => $usuario->getTipo()->toString(),
            'criado_em' => $usuario->getCriadoEm()->format('Y-m-d H:i:s'),
        ]);
    }

    #[Route('/listar-todos', name: 'visualizar_todos_usuario', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function viewUserAll(): JsonResponse
    {
        $usuarios = $this->usuarioRepository->listarTodos();
        $dados = array_map(fn($usuario) => [
            'id' => $usuario->getId(),
            'cpf' => $usuario->getCpf(),
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'telefone' => $usuario->getTelefone(),
            'tipo' => $usuario->getTipo()->toString(),
            'criado_em' => $usuario->getCriadoEm()->format('Y-m-d H:i:s'),
        ], $usuarios);

        return new JsonResponse($dados);
    }

    #[Route('/remover/{id}', name: 'remover_usuario', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function remover(int $id): JsonResponse
    {
        try {
            $this->removerUsuario->executar($id);
            return new JsonResponse(['mensagem' => 'Usuário removido com sucesso.']);
        } catch (\DomainException $e) {
            return new JsonResponse(['erro' => $e->getMessage()], 400);
        }
    }
}
