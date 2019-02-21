<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vip_request")
 * @ORM\Entity
 */
class Vip_request
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_request;

    /**
     * @ORM\Column(type="string")
     */
    private $content_request;

    /**
     * @ORM\Column(type="string")
     */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    public function getId_Request()
    {
        return $this->id_request;
    }

    public function setIdR_equest($id_request)
    {
        $this->id_request = $id_request;
    }


    public function getContent_Request()
    {
        return $this->content_request;
    }


    public function setContent_Request($content_request)
    {
        $this->content_request = $content_request;
    }


    public function getFile()
    {
        return $this->file;
    }


    public function setFile($file)
    {
        $this->file = $file;
    }


    public function getCreation_Date()
    {
        return $this->creation_date;
    }


    public function setCreation_Date($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}

