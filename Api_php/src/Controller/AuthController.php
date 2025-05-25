<?php

namespace App\Controller;

use Core\UseCase\Usuario\AutenticarUsuario;
use Core\UseCase\Usuario\DTO\LoginInputDto;
use Core\UseCase\Usuario\RegistrarUsuario;
use Core\UseCase\Usuario\VisualizarUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auth')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly AutenticarUsuario $autenticarUsuario,
        private RegistrarUsuario $registrarUsuario,
        private VisualizarUsuario $visualizarUsuario
    ) {}

    #[Route('/registrar-usuario', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $content = $request->getContent();
        if (empty($content)) {
            return new JsonResponse(['erro' => 'JSON vazio'], 400);
        }

        $dados = json_decode($content, true);
        if (is_null($dados)) {
            return new JsonResponse(['erro' => 'JSON inválido'], 400);
        }

        try {
            $usuario = $this->registrarUsuario->executar($dados);

            return new JsonResponse([
                'Cliente criado com sucesso',
                'id' => $usuario->getId(),
                'nome' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'cpf' => $usuario->getCpf(),
                'telefone' => $usuario->getTelefone(),
                'grupo' => $usuario->getTipo()->toString(),
                'criado_em' => $usuario->getCriadoEm()->format('Y-m-d H:i:s'),
            ], JsonResponse::HTTP_CREATED);
        } catch (\DomainException $e) {
            return new JsonResponse([
                'erro' => 'Erro inesperado: ' . $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $dados = json_decode($request->getContent(), true);
        if (!$dados || empty($dados['email']) || empty($dados['senha'])) {
            return new JsonResponse(['erro' => 'Email e senha são obrigatórios.'], 400);
        }

        try {
            $dto = new LoginInputDto($dados['email'], $dados['senha']);
            $token = $this->autenticarUsuario->executar($dto);

            return new JsonResponse([
                'resposta'=> 'token criado com sucesso',
                'token' => $token], 200);
        } catch (\Throwable $e) {
            return new JsonResponse(['erro' => $e->getMessage()], 401);
        }
    }
}
