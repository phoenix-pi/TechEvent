<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="event_likes")
 * @ORM\Entity
 */
class Event_likes
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_like;


    /**
     *@ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */private $user;


    /**
     *@ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="event_id",referencedColumnName="id_event")
     */private $event;


    /**
     *@ORM\Column(type="integer")
     */private $nb_likes;


    public function getId_Like()
    {
        return $this->id_like;
    }

    public function setId_Like($id_like)
    {
        $this->id_like = $id_like;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }

    public function getNb_Likes()
    {
        return $this->nb_likes;
    }

    public function setNb_Likes($nb_likes)
    {
        $this->nb_likes = $nb_likes;
    }






}