<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")]
 * @UniqueEntity(fields="user_email", message="Účet s danou emailovou adresou už je registrován.")
 * @UniqueEntity(fields="user_name", message="Účet s daným uživatelským jménem už je registrován.")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     * @Assert\NotBlank(message="Uživatelské jméno nesmí být prázdné.")
     * @Assert\NotNull(message="Uživatelské jméno nesmí být prázdné.")
     * @Assert\Length(max=20, maxMessage = "Uživatelské jméno může mít maximálně {{ limit }} znaků.")
     */
    private $user_name;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $password;

    /**
     * @Assert\NotBlank(message="Heslo nesmí být prázdné.")
     * @Assert\NotNull(message="Heslo nesmí být prázdné.")
     * @Assert\Length(max=4096, min=4, minMessage = "Váše heslo musí být alespoň {{ limit }} znaky dlouhé.", maxMessage = "Překročily jste maximální délku hesla")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     * @Assert\NotBlank(message="Email nesmí být prázdný.")
     * @Assert\NotNull(message="Email nesmí být prázdný.")
     * @Assert\Email(message="Musí být zadán validní email.")
     * @Assert\Length(max=40, maxMessage = "Email může mít maximálně {{ limit }} znaků.")
     */
    private $user_email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $role;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date()
     */
    private $joined;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="user")
     */
    private $comments;

    //------------------------------------------------------------------------------------------------------------------

    public function __construct()
    {
        $this->isActive = true;
        $this->comments = new ArrayCollection();
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->user_id,
            $this->user_name,
            $this->password,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->user_id,
            $this->user_name,
            $this->password,
            ) = unserialize($serialized);
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $id
     */
    public function setUserId($id)
    {
        $this->user_id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
 * @return mixed
 */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * @param mixed $isActive
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;
    }


    // add your own fields
}
