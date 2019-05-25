<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="vip_request")
 * @ORM\Entity
 * @Vich\Uploadable
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
     *@ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;



    /**
     * @ORM\Column(type="string")
     */
    private $content_request;

    /**
     * @return mixed
     */
    public function getContentRequest()
    {
        return $this->content_request;
    }
    public function getContent_Request()
    {
        return $this->content_request;
    }

    /**
     * @param mixed $content_request
     */
    public function setContentRequest($content_request)
    {
        $this->content_request = $content_request;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }



    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @Vich\UploadableField(mapping="devis", fileNameProperty="devisName")
     *
     * @var File
     */
    private $devisFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $devisName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;



    public function getId_Request()
    {
        return $this->id_request;
    }

    public function setId_Request($id_request)
    {
        $this->id_request = $id_request;
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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $devis
     *
     * @return Devis
     */
    public function setDevisFile(File $devis = null)
    {
        $this->devisFile = $devis;

        if ($devis)
            $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @return File|null
     */
    public function getDevisFile()
    {
        return $this->devisFile;
    }

    /**
     * @param string $devisName
     *
     * @return Devis
     */
    public function setDevisName($devisName)
    {
        $this->devisName = $devisName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDevisName()
    {
        return $this->devisName;
    }



}

