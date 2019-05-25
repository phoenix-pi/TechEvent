<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/18/2019
 * Time: 10:33 PM
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="theme")
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */private $id_theme;
    /**
     * @ORM\Column(type="string")
     */private $theme_name;

    public function getId_Theme()
    {
        return $this->id_theme;
    }

    public function setId_Theme($id_theme)
    {
        $this->id_theme = $id_theme;
    }

    public function getIdTheme()
    {
        return $this->id_theme;
    }

    public function setIdTheme($id_theme)
    {
        $this->id_theme = $id_theme;
    }

    public function getTheme_Name()
    {
        return $this->theme_name;
    }


    public function setTheme_Name($theme_name)
    {
        $this->theme_name = $theme_name;
    }

    public function getThemeName()
    {
        return $this->theme_name;
    }


    public function setThemeName($theme_name)
    {
        $this->theme_name = $theme_name;
    }

}