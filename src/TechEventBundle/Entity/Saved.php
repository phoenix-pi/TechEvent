<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 16:19
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\SavedRepository")
 * @ORM\Table(name="saved")
 */

class Saved
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_saved;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_save;

    /**
     * @ORM\ManyToOne(targetEntity="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id_article")
     */
    private $article;

    public function getId_Saved()
    {
        return $this->id_saved;
    }

    public function setId_Saved($id_saved)
    {
        $this->id_saved = $id_saved;
    }

    public function getDateSave()
    {
        return $this->date_save;
    }

    public function setDate_Save($date_save)
    {
        $this->date_save = $date_save;
    }

    public function getUser()
    {
        return $this->user;
    }


    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }


}