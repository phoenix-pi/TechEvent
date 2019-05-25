<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 17:44
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_category;


    /**
     * @ORM\Column(type="string")
     */
    private $category_name;

    /**
     * @return int
     */
    public function getId_Category()
    {
        return $this->id_category;
    }

    public function setId_Category($id_category)
    {
        $this->id_category = $id_category;
    }

    public function getCategory_Name()
    {
        return $this->category_name;
    }

    public function setCategory_Name($category_name)
    {
        $this->category_name = $category_name;
    }


    public function getIdCategory()
    {
        return $this->id_category;
    }

    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }
}