<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 17:37
 */

namespace TechEventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
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

    /**
     * @ORM\OneToMany(targetEntity="TechEventBundle\Entity\Event_likes" ,mappedBy="event")
     *
     */
    private $eventsLike;

    public function __construct()
    {
        $this->eventsLike = new ArrayCollection();
    }

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
     * @ORM\Column(type="integer")
     */
    private $nb_like;

    /**
     * @return mixed
     */
    public function getNbLike()
    {
        return $this->nb_like;
    }

    /**
     * @param mixed $nb_like
     */
    public function setNbLike($nb_like)
    {
        $this->nb_like = $nb_like;
    }


    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="organizer_id",referencedColumnName="id")
     */
    private $organizer;


    /**
     * @ORM\Column(type="string", nullable=true)
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
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive;


    private $isLiked;

    private $timecompare ;

    /**
     * @return mixed
     */
    public function getTimecompare()
    {
        return $this->timecompare;
    }

    /**
     * @param mixed $timecompare
     */
    public function setTimecompare($timecompare)
    {
        $this->timecompare = $timecompare;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

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

    /**
     * @return mixed
     */
    public function getisLiked()
    {
        return $this->isLiked;
    }

    /**
     * @param mixed $isLiked
     */
    public function setIsLiked($isLiked)
    {
        $this->isLiked = $isLiked;
    }


}