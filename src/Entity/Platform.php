<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatformRepository")
 */
class Platform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $platform_id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $platform_name;

    //------------------------------------------------------------------------------------------------------------------

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
