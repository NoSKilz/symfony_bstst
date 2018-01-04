<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $comment_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="comments")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $comment_text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploaded;

    //------------------------------------------------------------------------------------------------------------------

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * @param mixed $comment_id
     */
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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
    public function getCommentText()
    {
        return $this->comment_text;
    }

    /**
     * @param mixed $comment_text
     */
    public function setCommentText($comment_text)
    {
        $this->comment_text = $comment_text;
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
}
