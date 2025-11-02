<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    // Reativamos todas as operações e definimos um grupo de leitura/escrita simples
    normalizationContext: ['groups' => ['usuario:read']],
    denormalizationContext: ['groups' => ['usuario:write']],
)]
#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['usuario:read'])] // Apenas para leitura
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    #[Groups(['usuario:read', 'usuario:write'])] // Leitura e escrita
    private ?string $nome = null;

    #[ORM\Column(length: 200)]
    #[Groups(['usuario:read', 'usuario:write'])] // Leitura e escrita
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    #[Groups(['usuario:write'])] // Apenas para escrita (não aparece na leitura)
    private ?string $senha = null; // A senha não será hasheada

    public function getId(): ?int
    {
        return $this->id;
    }

    // Remover setId se você não precisar definir o ID manualmente
    // public function setId(int $id): static { $this->id = $id; return $this; }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): static
    {
        $this->senha = $senha;

        return $this;
    }
}
