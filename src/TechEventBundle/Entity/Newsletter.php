<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 16:33
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="newsletter")
 */

class Newsletter
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_newsletter;
    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    public function getId_Newsletter()
    {
        return $this->id_newsletter;
    }

    public function setId_Newsletter($id_newsletter)
    {
        $this->id_newsletter = $id_newsletter;
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