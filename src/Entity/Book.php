<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $book_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $book_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $pub_id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=8)
     */
    private $book_price;

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

    public function getBookName(): ?int
    {
        return $this->book_name;
    }

    public function setBookName(?int $book_name): self
    {
        $this->book_name = $book_name;

        return $this;
    }

    public function getPubId(): ?int
    {
        return $this->pub_id;
    }

    public function setPubId(int $pub_id): self
    {
        $this->pub_id = $pub_id;

        return $this;
    }

    public function getBookPrice()
    {
        return $this->book_price;
    }

    public function setBookPrice($book_price): self
    {
        $this->book_price = $book_price;

        return $this;
    }
}
