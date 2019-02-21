<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 18/02/2019
 * Time: 21:34
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blacklist")
 */
class Blacklist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_blacklist;

    public function getId_BlackList()
    {
        return $this->id_blacklist;
    }

    public function setId_BlackList($id_bl)
    {
        $this->id_blacklist = $id_bl;
    }

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="id"))
     */
    private $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

}