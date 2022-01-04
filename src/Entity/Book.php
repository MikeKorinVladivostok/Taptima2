<?php

namespace App\Entity;

use App\Controller\BookController;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Object_;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $book_name;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity=CoauthorNew::class, mappedBy="book")
     */
    private $coauthorNews;

    public function __construct()
    {
        $this->coauthorNews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookName(): ?string
    {
        return $this->book_name;
    }

    public function setBookName(?string $book_name): self
    {
        $this->book_name = $book_name;

        return $this;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|CoauthorNew[]
     */
    public function getCoauthorNews(): Collection
    {
        return $this->coauthorNews;
    }

    public function addCoauthorNews(CoauthorNew $coauthorNews): self
    {
        if (!$this->coauthorNews->contains($coauthorNews)) {
            $this->coauthorNews[] = $coauthorNews;
            $coauthorNews->setBook($this);
        }

        return $this;
    }

    public function removeCoauthorNews(CoauthorNew $coauthorNews): self
    {
        if ($this->coauthorNews->removeElement($coauthorNews)) {
            // set the owning side to null (unless already changed)
            if ($coauthorNews->getBook() === $this) {
                $coauthorNews->setBook(null);
            }
        }

        return $this;
    }

}
