<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $descripcion;

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: Libro::class)]
    private $serie_libro;

    public function __construct()
    {
        $this->serie_libro = new ArrayCollection();
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
    public function getSerieLibro(): Collection
    {
        return $this->serie_libro;
    }

    public function addSerieLibro(Libro $serieLibro): self
    {
        if (!$this->serie_libro->contains($serieLibro)) {
            $this->serie_libro[] = $serieLibro;
            $serieLibro->setSerie($this);
        }

        return $this;
    }

    public function removeSerieLibro(Libro $serieLibro): self
    {
        if ($this->serie_libro->removeElement($serieLibro)) {
            // set the owning side to null (unless already changed)
            if ($serieLibro->getSerie() === $this) {
                $serieLibro->setSerie(null);
            }
        }

        return $this;
    }
}
