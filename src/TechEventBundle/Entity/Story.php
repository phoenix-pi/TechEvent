<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="story")
 * @ORM\Entity
 */
class Story
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_story;

    /**
     *@ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */private $user;

    /**
     * @ORM\Column(type="string")
     */
    private $content_story;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;



    public function getId_Story()
    {
        return $this->id_story;
    }


    public function setId_Story($id_story)
    {
        $this->id_story = $id_story;
    }


    public function getContent_Story()
    {
        return $this->content_story;
    }


    public function setContent_Story($content_story)
    {
        $this->content_story = $content_story;
    }


    public function getCreation_Date()
    {
        return $this->creation_date;
    }

    public function setCreation_Date($creation_date)
    {
        $this->creation_date = $creation_date;
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

