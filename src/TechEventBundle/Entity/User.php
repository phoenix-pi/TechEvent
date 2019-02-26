<?php

namespace TechEventBundle\Entity;

use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubRepository")
 * @ORM\Table(name="fos_user")
 */
 class User extends BaseUser implements ParticipantInterface
 {
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
      * @ORM\Column(type="string")
      */
     private $firstName;
     /**
      * @ORM\Column(type="string")
      */
     private $lastName;

     /**
      * @ORM\Column(type="string",nullable=true)
      */
     private $address;

     /**
      * @ORM\Column(type="string",nullable=true)
      */
     private $phone;

     /**
      * @ORM\Column(type="string",nullable=true)
      */
     private $status;

     /**
      * @ORM\Column(type="string",nullable=true)
      */
     private $picture;


     /**
      * @ORM\Column(name="facebook_id", type="string", nullable=true)
      */
     protected $facebook_id;

     /**
      * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
      */
     protected $facebook_access_token;

     /**
      * @ORM\Column(name="google_id", type="string", length=255, nullable=true)
      */
     protected $google_id;

     /**
      * @ORM\Column(name="google_access_token", type="string", length=255, nullable=true)
      */
     protected $google_access_token;



     public function getId()
     {
         return $this->id;
     }

     public function setId($id)
     {
         $this->id = $id;
     }

     public function getFacebook_Id()
     {
         return $this->facebook_id;
     }


     public function setFacebook_Id($facebook_id)
     {
         $this->facebook_id = $facebook_id;
     }


     public function getFacebook_Access_Token()
     {
         return $this->facebook_access_token;
     }

     public function setFacebook_Access_Token($facebook_access_token)
     {
         $this->facebook_access_token = $facebook_access_token;
     }


     public function get_Google_Id()
     {
         return $this->google_id;
     }

 
     public function setGoogle_Id($google_id)
     {
         $this->google_id = $google_id;
     }


     public function getGoogle_Access_Token()
     {
         return $this->google_access_token;
     }


     public function setGoogle_Access_Token($google_access_token)
     {
         $this->google_access_token = $google_access_token;
     }


     public function getAddress()
     {
         return $this->address;
     }


     public function setAddress($address)
     {
         $this->address = $address;
     }


     public function getPhone()
     {
         return $this->phone;
     }


     public function setPhone($phone)
     {
         $this->phone = $phone;
     }


     public function getStatus()
     {
         return $this->status;
     }


     public function setStatus($status)
     {
         $this->status = $status;
     }

     public function getPicture()
     {
         return $this->picture;
     }


     public function setPicture($picture)
     {
         $this->picture = $picture;
     }



 public function __construct()
 {
        parent::__construct();
 }


     public function getFirstName()
     {
         return $this->firstName;
     }


     public function setFirstName($first_name)
     {
         $this->firstName = $first_name;
     }


     public function getLastName()
     {
         return $this->lastName;
     }


     public function setLastName($last_name)
     {
         $this->lastName = $last_name;
     }


 }