<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/18/2019
 * Time: 10:21 PM
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubRepository")
 * @ORM\Table(name="club")
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */private $id_club;
    /**
     * @ORM\Column(type="string")
     */private $club_name;
    /**
     * @ORM\Column(type="string")
     */private $logo;
    /**
     * @ORM\Column(type="string")
     */private $club_description;
    /**
     * @ORM\Column(type="string")
     */private $email;
    /**
     * @ORM\Column(type="string")
     */private $facebook;
    /**
     * @ORM\Column(type="string")
     */private $club_status="Waiting";

    /**
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id_theme",nullable=true)
     */
     private $theme;

    public function getId_Club()
    {
        return $this->id_club;
    }


    public function setId_Club($id_club)
    {
        $this->id_club = $id_club;
    }


    public function getClub_Name()
    {
        return $this->club_name;
    }


    public function setClub_Name($club_name)
    {
        $this->club_name = $club_name;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function getClub_Description()
    {
        return $this->club_description;
    }

    public function setClub_Description($club_description)
    {
        $this->club_description = $club_description;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getFacebook()
    {
        return $this->facebook;
    }


    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }


    public function getClub_Status()
    {
        return $this->club_status;
    }


    public function setClub_Status($club_status)
    {
        $this->club_status = $club_status;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;


    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
    }


}