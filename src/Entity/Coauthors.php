<?php

namespace App\Entity;

use App\Repository\CoauthorsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoauthorsRepository::class)
 */
class Coauthors
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $book_id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $author_id;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $main_author;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMainAuthor(): ?bool
    {
        return $this->main_author;
    }

    public function setMainAuthor(bool $main_author): self
    {
        $this->main_author = $main_author;

        return $this;
    }
}
