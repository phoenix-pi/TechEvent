<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 16:36
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscriber")
 */
class Subscriber
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_subscriber;
    /**
     * @ORM\Column(type="string")
     */
    private $email_subscriber;

    /**
     * @ORM\ManyToOne(targetEntity="domain")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id_domain")
     */
    private $domain;

    public function getId_Subscriber()
    {
        return $this->id_subscriber;
    }

    public function setId_Subscriber($id_subscriber)
    {
        $this->id_subscriber = $id_subscriber;
    }

    public function getEmail_Subscriber()
    {
        return $this->email_subscriber;
    }

    public function setEmail_Subscriber($email_subscriber)
    {
        $this->email_subscriber = $email_subscriber;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }



}