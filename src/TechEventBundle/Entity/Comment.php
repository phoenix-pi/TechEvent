<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 16/02/2019
 * Time: 17:33
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id_comment;

    public function getId_Comment()
    {
        return $this->id_comment;
    }

    public function setId_Comment($id_comment)
    {
        $this->id_comment = $id_comment;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $content;


    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_of_comment;


    public function getDate_Of_Comment()
    {
        return $this->date_of_comment;
    }

    public function setDate_Of_Comment($date_of_comment)
    {
        $this->date_of_comment = $date_of_comment;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Event"))
     * @ORM\JoinColumn(name="event_id",referencedColumnName="id_event")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="User"))
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }



}