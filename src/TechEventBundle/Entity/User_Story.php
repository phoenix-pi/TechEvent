<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 **@ORM\Entity(repositoryClass="ProfilBundle\Repository\User_StoryRepository")
 * @ORM\Table(name="user_story")
 */
class User_Story
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_user_story;

    /**
     *@ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id", onDelete="CASCADE")
     */private $user;

    /**
     *@ORM\ManyToOne(targetEntity="Story")
     * @ORM\JoinColumn(name="story_id",referencedColumnName="id_story", onDelete="CASCADE")
     */private $story;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;



    public function getId_User_Story()
    {
        return $this->id_user_story;
    }


    public function setId_User_Story($id_user_story)
    {
        $this->id_user_story = $id_user_story;
    }


    public function getUser()
    {
        return $this->user;
    }


    public function setId_User($user)
    {
        $this->user = $user;
    }


    public function getStory()
    {
        return $this->story;
    }


    public function setId_Story($story)
    {
        $this->story = $story;
    }


    public function getCreation_Date()
    {
        return $this->creation_date;
    }


    public function setCreation_Date($creation_date)
    {
        $this->creation_date = $creation_date;
    }

}

