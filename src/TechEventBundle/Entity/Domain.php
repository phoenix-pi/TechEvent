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
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\DomainRepository")
 * @ORM\Table(name="domain")
 */

class Domain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDomain;
    /**
     * @ORM\Column(type="string")
     */
    private $nameDomain;

    /**
     * @return mixed
     */
    public function getIdDomain()
    {
        return $this->idDomain;
    }

    /**
     * @param mixed $idDomain
     */
    public function setIdDomain($idDomain)
    {
        $this->idDomain = $idDomain;
    }

    /**
     * @return mixed
     */
    public function getNameDomain()
    {
        return $this->nameDomain;
    }

    /**
     * @param mixed $nameDomain
     */
    public function setNameDomain($nameDomain)
    {
        $this->nameDomain = $nameDomain;
    }


}