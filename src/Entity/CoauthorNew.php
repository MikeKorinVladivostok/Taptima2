<?php

namespace App\Entity;

use App\Repository\CoauthorNewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoauthorNewRepository::class)
 */
class CoauthorNew
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="coauthorNews")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="coauthorNews")
     */
    private $author;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $book_id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $author_id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $main_author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getMainAuthor(): ?int
    {
        return $this->main_author;
    }

    public function setMainAuthor(?int $main_author): self
    {
        $this->main_author = $main_author;

        return $this;
    }

    public function getBookId(): ?int
    {
        return $this->book_id;
    }

    public function setBookId(int $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getAuthorId(): ?int
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id): self
    {
        $this->author_id = $author_id;

        return $this;
    }
}
