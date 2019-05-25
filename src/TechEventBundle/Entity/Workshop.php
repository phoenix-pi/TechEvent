<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/18/2019
 * Time: 10:30 PM
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="workshop")
 */
class Workshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */private $id_workshop;
    /**
     * @ORM\Column(type="string")
     */private $title;
    /**
     * @ORM\Column(type="integer")
     */private $nbr_places;
    /**
     * @ORM\Column(type="string")
     */private $workshop_description;
    /**
     * @ORM\Column(type="datetime")
     */private $start_date;

    /**
     * @ORM\Column(type="string")
     */private $location;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Club")
     * @ORM\JoinColumn(name="club_id",referencedColumnName="id_club", onDelete="CASCADE")
     */
    protected $club;



    public function getId_Workshop()
    {
        return $this->id_workshop;
    }


    public function setId_Workshop($id_workshop)
    {
        $this->id_workshop = $id_workshop;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getNbr_Places()
    {
        return $this->nbr_places;
    }


    public function setNbr_Places($nbr_places)
    {
        $this->nbr_places = $nbr_places;
    }


    public function getWorkshop_Description()
    {
        return $this->workshop_description;
    }


    public function setWorkshop_Description($workshop_description)
    {
        $this->workshop_description = $workshop_description;
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

    /**
     * @param mixed $end_date
     */
    public function setEnd_Date($end_date)
    {
        $this->end_date = $end_date;
    }


    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }


}