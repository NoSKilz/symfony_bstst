<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository")
 * @UniqueEntity(fields="genre_name", message="Žánr s daným jénem už existuje")
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $genre_id;

    /**
     * @ORM\Column(type="string", length=20, unique=true, nullable=FALSE, options={"collate"="utf8_czech_ci"})
     */
    private $genre_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="genre")
     */
    private $products;

    //------------------------------------------------------------------------------------------------------------------

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genre_id;
    }

    /**
     * @param mixed $genre_id
     */
    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;
    }

    /**
     * @return mixed
     */
    public function getGenreName()
    {
        return $this->genre_name;
    }

    /**
     * @param mixed $genre_name
     */
    public function setGenreName($genre_name)
    {
        $this->genre_name = $genre_name;
    }

    // add your own fields
}
