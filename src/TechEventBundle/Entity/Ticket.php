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
 * @ORM\Entity(repositoryClass="CartBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id_ticket;


    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $code;
    /**
     * @ORM\Column(type="datetime")
     */
    private $time_booked;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user_ticket;
    /**
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="event_id",referencedColumnName="id_event")
     */
    private $event_ticket;


    public function getId_Ticket()
    {
        return $this->id_ticket;
    }

    public function setId_Ticket($id_ticket)
    {
        $this->id_ticket = $id_ticket;
    }


    public function getCode()
    {
        return $this->code;
    }


    public function setCode($code)
    {
        $this->code = $code;
    }


    public function getTime_Booked()
    {
        return $this->time_booked;
    }


    public function setTime_Booked($time_booked)
    {
        $this->time_booked = $time_booked;
    }


    public function getUser_Ticket()
    {
        return $this->user_ticket;
    }


    public function setUser_Ticket($user_ticket)
    {
        $this->user_ticket = $user_ticket;
    }


    public function getEvent_Ticket()
    {
        return $this->event_ticket;
    }


    public function setEvent_Ticket($event_ticket)
    {
        $this->event_ticket = $event_ticket;
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $qr_code;

    public function getQrCode()
    {
        return $this->qr_code;
    }

    public function setQrCode($qr_code)
    {
        $this->qr_code = $qr_code;
    }



}