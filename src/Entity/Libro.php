<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\ManyToMany(targetEntity: Author::class)]
    private $id_author;

    #[ORM\Column(type: 'float')]
    private $precio;

    #[ORM\Column(type: 'integer')]
    private $num_page;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fecha_lanzamiento;

    #[ORM\Column(type: 'string', length: 20)]
    private $ISBN;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagen;

    #[ORM\ManyToMany(targetEntity: Genero::class, mappedBy: 'libro_genero')]
    private $generos;



    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'serie_libro')]
    private $serie;

    #[ORM\ManyToOne(targetEntity: Editorial::class, inversedBy: 'libros')]
    private $editorial;









    public function __construct()
    {
        $this->id_author = new ArrayCollection();
        $this->generos = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getIdAuthor(): Collection
    {
        return $this->id_author;
    }

    public function addIdAuthor(Author $idAuthor): self
    {
        if (!$this->id_author->contains($idAuthor)) {
            $this->id_author[] = $idAuthor;
        }

        return $this;
    }

    public function removeIdAuthor(Author $idAuthor): self
    {
        $this->id_author->removeElement($idAuthor);

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getNumPage(): ?int
    {
        return $this->num_page;
    }

    public function setNumPage(int $num_page): self
    {
        $this->num_page = $num_page;

        return $this;
    }

    public function getFechaLanzamiento(): ?\DateTimeInterface
    {
        return $this->fecha_lanzamiento;
    }

    public function setFechaLanzamiento(?\DateTimeInterface $fecha_lanzamiento): self
    {
        $this->fecha_lanzamiento = $fecha_lanzamiento;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return Collection<int, Genero>
     */
    public function getGeneros(): Collection
    {
        return $this->generos;
    }

    public function addGenero(Genero $genero): self
    {
        if (!$this->generos->contains($genero)) {
            $this->generos[] = $genero;
            $genero->addLibroGenero($this);
        }

        return $this;
    }

    public function removeGenero(Genero $genero): self
    {
        if ($this->generos->removeElement($genero)) {
            $genero->removeLibroGenero($this);
        }

        return $this;
    }



    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }

    public function setEditorial(?Editorial $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }


}
