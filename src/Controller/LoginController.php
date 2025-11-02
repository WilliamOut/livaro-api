<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    // Rota: POST /api/login
    #[Route('/api/usuarios/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // 1. Decodifica o JSON da requisição
        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? null;
        $senha = $data['senha'] ?? null;

        if (!$email || !$senha) {
            return new JsonResponse(['message' => 'Email e senha são obrigatórios.'], 400);
        }

        // 2. Busca o usuário pelo email
        $usuario = $em->getRepository(Usuario::class)->findOneBy(['email' => $email]);

        if (!$usuario) {
            return new JsonResponse(['message' => 'Credenciais inválidas.'], 401);
        }

        // 3. Verifica a Senha (COMPARAÇÃO EM TEXTO PURO)
        // ATENÇÃO: Isto só é aceitável em desenvolvimento simples SEM HASH!
        if ($usuario->getSenha() !== $senha) {
            return new JsonResponse(['message' => 'Credenciais inválidas.'], 401);
        }

        // 4. Sucesso: Retorna uma mensagem de sucesso e o ID/Email
        return new JsonResponse([
            'message' => 'Logado',
            'usuario_id' => $usuario->getId(),
            'email' => $usuario->getEmail()
        ]);
    }
}
