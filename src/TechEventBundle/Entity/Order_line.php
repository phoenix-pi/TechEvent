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
class Order_line
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id_line;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $price;
    /**
     * @ORM\ManyToOne(targetEntity="Ticket")
     * @ORM\JoinColumn(name="ticket_id",referencedColumnName="id_ticket")
     */
    private $line_ticket;
    /**
     * @ORM\ManyToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cart_id",referencedColumnName="id_cart")
     */
    private $line_cart;

    public function getId_Line()
    {
        return $this->id_line;
    }

    public function setId_Line($id_line)
    {
        $this->id_line = $id_line;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function getLine_Ticket()
    {
        return $this->line_ticket;
    }


    public function setLine_Ticket($line_ticket)
    {
        $this->line_ticket = $line_ticket;
    }


    public function getLine_Cart()
    {
        return $this->line_cart;
    }

    public function setLine_Cart($line_cart)
    {
        $this->line_cart = $line_cart;
    }


}