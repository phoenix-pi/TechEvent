<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 16:20
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="domain")
 */

class Domain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_domain;
    /**
     * @ORM\Column(type="string")
     */
    private $name_domain;

    public function getId_Domain()
    {
        return $this->id_domain;
    }

    public function setId_Domain($id_domain)
    {
        $this->id_domain = $id_domain;
    }

    public function getName_Domain()
    {
        return $this->name_domain;
    }

    public function setName_Domain($name_domain)
    {
        $this->name_domain = $name_domain;
    }
}