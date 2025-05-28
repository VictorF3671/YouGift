<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Infra\JwtTokenService;
use App\Repository\AuthUsuarioRepository;
use App\Repository\UsuarioRepository;
use Core\Domain\Usuario\Repository\IUsuarioRepository;
use Core\UseCase\Usuario\AutenticarUsuario;
use Core\UseCase\Usuario\DTO\LoginInputDto;
use Core\UseCase\Usuario\RegistrarUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/auth')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly AutenticarUsuario $autenticarUsuario,
        private RegistrarUsuario $registrarUsuario,
        private AuthUsuarioRepository $usuarioRepositoryOrm,
        private JwtTokenService $jwtService
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
            $usuario = $this->usuarioRepositoryOrm->loadUserByIdentifier($dto->email);

            $token = $this->jwtService->gerarToken($usuario);

            return new JsonResponse([
                'token' => $token,
                'role' => $usuario->getRoles()[0], // ROLE_USER ou ROLE_ADMIN
            ], 200);
        } catch (\Throwable $e) {
            return new JsonResponse(['erro' => $e->getMessage()], 401);
        }
    }
}
