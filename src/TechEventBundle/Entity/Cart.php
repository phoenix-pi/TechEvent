<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 17:54
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Cart
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id_cart;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE")
     */
    private $user_cart;

    public function getId_Cart()
    {
        return $this->id_cart;
    }
    public function getIdCart()
    {
        return $this->id_cart;
    }

    public function setId_Cart($id_cart)
    {
        $this->id_cart = $id_cart;
    }


    public function getTotal()
    {
        return $this->total;
    }


    public function setTotal($total)
    {
        $this->total = $total;
    }


    public function getUser_Cart()
    {
        return $this->user_cart;
    }

    public function getUserCart()
    {
        return $this->user_cart;
    }

    public function setUser_Cart($user_cart)
    {
        $this->user_cart = $user_cart;
    }
}