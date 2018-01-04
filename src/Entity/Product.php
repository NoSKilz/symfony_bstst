<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $product_id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $platform_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Platform", inversedBy="products")
     * @ORM\JoinColumn(name="platform_name", referencedColumnName="platform_id")
     */
    private $platform;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $genre_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="products")
     * @ORM\JoinColumn(name="genre_name", referencedColumnName="genre_id")
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $product_name;

    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploaded;

    /**
     * @ORM\Column(type="integer")
     */
    private $sold;

    /**
     * @ORM\Column(type="integer")
     */
    private $in_stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $delivery_time;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="product")
     */
    private $comments;

    //------------------------------------------------------------------------------------------------------------------

    public function getPlatform(): Platform
    {
        return $this->platform;
    }

    public function setPlatform(Platform $platform)
    {
        $this->platform = $platform;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getPlatformName()
    {
        return $this->platform_name;
    }

    /**
     * @param mixed $platform_name
     */
    public function setPlatformName($platform_name)
    {
        $this->platform_name = $platform_name;
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

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param mixed $product_name
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getUploaded()
    {
        return $this->uploaded;
    }

    /**
     * @param mixed $uploaded
     */
    public function setUploaded($uploaded)
    {
        $this->uploaded = $uploaded;
    }

    /**
     * @return mixed
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * @param mixed $sold
     */
    public function setSold($sold)
    {
        $this->sold = $sold;
    }

    /**
     * @return mixed
     */
    public function getInStock()
    {
        return $this->in_stock;
    }

    /**
     * @param mixed $in_stock
     */
    public function setInStock($in_stock)
    {
        $this->in_stock = $in_stock;
    }

    /**
     * @return mixed
     */
    public function getDeliveryTime()
    {
        return $this->delivery_time;
    }

    /**
     * @param mixed $delivery_time
     */
    public function setDeliveryTime($delivery_time)
    {
        $this->delivery_time = $delivery_time;
    }
}
