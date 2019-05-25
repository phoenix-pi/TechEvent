<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/18/2019
 * Time: 10:36 PM
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubRepository")
 * @ORM\Table(name="club_user")
 */
class ClubUser
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */

    private $id_club_user;
    /**
     * @ORM\Column(type="string")
     */private $club_user_status="Waiting";
    /**
     * @ORM\Column(type="string")
     */private $why;
    /**
     * @ORM\Column(type="string")
     */private $you_are;
    /**
     * @ORM\Column(type="string")
     */private $skills;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $member;

    /**
     * @return mixed
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param mixed $member
     */
    public function setMember($member)
    {
        $this->member = $member;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Club")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id_club", onDelete="CASCADE")
     */
    private $club;



    public function getClub_User_Status()
    {
        return $this->club_user_status;
    }


    public function setClub_User_Status($club_user_status)
    {
        $this->club_user_status = $club_user_status;
    }


    public function getWhy()
    {
        return $this->why;
    }


    public function setWhy($why)
    {
        $this->why = $why;
    }


    public function getYou_Are()
    {
        return $this->you_are;
    }


    public function setYou_Are($you_are)
    {
        $this->you_are = $you_are;
    }


    public function getSkills()
    {
        return $this->skills;
    }


    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    public function getId_Club_User()
    {
        return $this->id_club_user;
    }

    public function setId_Club_User($id_club_user)
    {
        $this->id_club_user = $id_club_user;
    }


    public function getUser()
    {
        return $this->user;
    }


    public function setUser($user)
    {
        $this->user = $user;
    }


    public function getClub()
    {
        return $this->club;
    }


    public function setClub($club)
    {
        $this->club = $club;
    }




}