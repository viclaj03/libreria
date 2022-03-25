<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $descripcion;

    #[ORM\ManyToMany(targetEntity: Libro::class, inversedBy: 'generos')]
    private $libro_genero;

    public function __construct()
    {
        $this->libro_genero = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Libro>
     */
    public function getLibroGenero(): Collection
    {
        return $this->libro_genero;
    }

    public function addLibroGenero(Libro $libroGenero): self
    {
        if (!$this->libro_genero->contains($libroGenero)) {
            $this->libro_genero[] = $libroGenero;
        }

        return $this;
    }

    public function removeLibroGenero(Libro $libroGenero): self
    {
        $this->libro_genero->removeElement($libroGenero);

        return $this;
    }
}
