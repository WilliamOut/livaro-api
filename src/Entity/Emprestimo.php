<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EmprestimoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: EmprestimoRepository::class)]
class Emprestimo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'idusuario', referencedColumnName: 'id')]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'idlivro', referencedColumnName: 'id')]
    private ?Livro $livro = null;

    #[ORM\Column]
    private ?int $diainicio = null;

    #[ORM\Column]
    private ?int $mesinicio = null;

    #[ORM\Column]
    private ?int $anoinicio = null;

    #[ORM\Column]
    private ?int $diafinal = null;

    #[ORM\Column]
    private ?int $mesfinal = null;

    #[ORM\Column]
    private ?int $anofinal = null;

    #[ORM\Column]
    private ?bool $stsentregue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getLivro(): ?Livro
    {
        return $this->livro;
    }

    public function setLivro(Livro $livro): static
    {
        $this->livro = $livro;

        return $this;
    }

    public function getDiainicio(): ?int
    {
        return $this->diainicio;
    }

    public function setDiainicio(int $diainicio): static
    {
        $this->diainicio = $diainicio;

        return $this;
    }

    public function getMesinicio(): ?int
    {
        return $this->mesinicio;
    }

    public function setMesinicio(int $mesinicio): static
    {
        $this->mesinicio = $mesinicio;

        return $this;
    }

    public function getAnoinicio(): ?int
    {
        return $this->anoinicio;
    }

    public function setAnoinicio(int $anoinicio): static
    {
        $this->anoinicio = $anoinicio;

        return $this;
    }

    public function getDiafinal(): ?int
    {
        return $this->diafinal;
    }

    public function setDiafinal(int $diafinal): static
    {
        $this->diafinal = $diafinal;

        return $this;
    }

    public function getMesfinal(): ?int
    {
        return $this->mesfinal;
    }

    public function setMesfinal(int $mesfinal): static
    {
        $this->mesfinal = $mesfinal;

        return $this;
    }

    public function getAnofinal(): ?int
    {
        return $this->anofinal;
    }

    public function setAnofinal(int $anofinal): static
    {
        $this->anofinal = $anofinal;

        return $this;
    }

    public function isStsentregue(): ?bool
    {
        return $this->stsentregue;
    }

    public function setStsentregue(bool $stsentregue): static
    {
        $this->stsentregue = $stsentregue;

        return $this;
    }
}
