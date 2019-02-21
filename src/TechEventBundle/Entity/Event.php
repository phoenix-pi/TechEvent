<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 17:37
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_event;

    /**
     * @ORM\Column(type="string")
     */
    private $event_name;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id",referencedColumnName="id_category")
     */
    private $category;

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }


    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="integer")
     */
    private $nb_participant;


    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="organizer_id",referencedColumnName="id")
     */
    private $organizer;


    /**
     * @ORM\Column(type="string")
     */
    private $photo;

    /**
     * @ORM\Column(type="string")
     */
    private $status;


    /**
     * @ORM\Column(type="datetime")
     */
    private $start_date;


    /**
     * @ORM\Column(type="datetime")
     */
    private $end_date;


    /**
     * @ORM\Column(type="datetime")
     */
    private $start_time;


    /**
     * @ORM\Column(type="datetime")
     */
    private $end_time;


    /**
     * @ORM\Column(type="boolean")
     */
    private $archive;


    public function getId_Event()
    {
        return $this->id_event;
    }

    public function setId_Event($id_event)
    {
        $this->id_event = $id_event;
    }

    public function getEvent_Name()
    {
        return $this->event_name;
    }

    public function setEvent_Name($event_name)
    {
        $this->event_name = $event_name;
    }

    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getNb_Participant()
    {
        return $this->nb_participant;
    }


    public function setNb_Participant($nb_participant)
    {
        $this->nb_participant = $nb_participant;
    }

    public function getOrganizer()
    {
        return $this->organizer;
    }


    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }


    public function getPhoto()
    {
        return $this->photo;
    }


    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function getStart_Date()
    {
        return $this->start_date;
    }


    public function setStart_Date($start_date)
    {
        $this->start_date = $start_date;
    }


    public function getEnd_Date()
    {
        return $this->end_date;
    }

    public function setEnd_Date($end_date)
    {
        $this->end_date = $end_date;
    }


    public function getStart_Time()
    {
        return $this->start_time;
    }


    public function setStart_Time($start_time)
    {
        $this->start_time = $start_time;
    }


    public function getEnd_Time()
    {
        return $this->end_time;
    }


    public function setEnd_Time($end_time)
    {
        $this->end_time = $end_time;
    }


    public function getArchive()
    {
        return $this->archive;
    }

    public function setArchive($archive)
    {
        $this->archive = $archive;
    }

    /**
     * @ORM\Column(type="float")
     */
    private $price_ticket;


    public function getPriceTicket()
    {
        return $this->price_ticket;
    }

    public function setPriceTicket($price_ticket)
    {
        $this->price_ticket = $price_ticket;
    }


}