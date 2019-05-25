<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * user_categorie
 *
 * @ORM\Table(name="user_categorie")
 * @ORM\Entity
 */
class user_categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_usercategorie;

    /**
     * @return int
     */
    public function getIdUsercategorie()
    {
        return $this->id_usercategorie;
    }

    /**
     * @param int $id_usercategorie
     */
    public function setIdUsercategorie($id_usercategorie)
    {
        $this->id_usercategorie = $id_usercategorie;
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * @param mixed $id_category
     */
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id",referencedColumnName="id_category" , onDelete="CASCADE")
     */
    private $id_category;



    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id" , onDelete="CASCADE")
     */
    private $id_user;


}

