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
     * @ORM\Column(type="integer")
     */
    private $nb_line;
    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user_cart;

    public function getId_Cart()
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


    public function getNb_Line()
    {
        return $this->nb_line;
    }


    public function setNb_Line($nb_line)
    {
        $this->nb_line = $nb_line;
    }


    public function getUser_Cart()
    {
        return $this->user_cart;
    }


    public function setUser_Cart($user_cart)
    {
        $this->user_cart = $user_cart;
    }
}
