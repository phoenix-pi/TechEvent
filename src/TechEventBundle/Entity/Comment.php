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
 * @ORM\Entity(repositoryClass="CommentBundle\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 *
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

    public function getIdComment()
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
     *
     */
    private $dateofcomment;

    /**
     * @return mixed
     */
    public function getDateofcomment()
    {
        return $this->dateofcomment;
    }

    /**
     * @param mixed $dateofcomment
     */
    public function setDateofcomment($dateofcomment)
    {
        $this->dateofcomment = $dateofcomment;
    }




    /**
     * @ORM\ManyToOne(targetEntity="Event"))
     * @ORM\JoinColumn(name="event_id",referencedColumnName="id_event", onDelete="CASCADE")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="User"))
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE")
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

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrep;

    /**
     * @return mixed
     */
    public function getNbrep()
    {
        return $this->nbrep;
    }

    /**
     * @param mixed $nbrep
     */
    public function setNbrep($nbrep)
    {
        $this->nbrep = $nbrep;
    }





}