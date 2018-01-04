<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatformRepository")
 * @UniqueEntity(fields="platform_name", message="Platforma s daným názvem už existuje.")
 */
class Platform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $platform_id;

    /**
     * @ORM\Column(type="string", length=20, unique=true, nullable=FALSE, options={"collate"="utf8_czech_ci"})
     */
    private $platform_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="platform")
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
    public function getPlatformId()
    {
        return $this->platform_id;
    }

    /**
     * @param mixed $platform_id
     */
    public function setPlatformId($platform_id)
    {
        $this->platform_id = $platform_id;
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

    // add your own fields
}
