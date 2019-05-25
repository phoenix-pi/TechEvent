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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="event_id",referencedColumnName="id_event", onDelete="CASCADE")
     */
    private $event;

    /**
     * @return mixed
     */
    public function getIdLike()
    {
        return $this->id_like;
    }

    /**
     * @param mixed $id_like
     */
    public function setIdLike($id_like)
    {
        $this->id_like = $id_like;
    }






    /**
     * @return mixed
     */
    public function getId_Like()
    {
        return $this->id_like;
    }

    /**
     * @param mixed $id_like
     */
    public function setId_Like($id_like)
    {
        $this->id_like = $id_like;
    }









    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }




}