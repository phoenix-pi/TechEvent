<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_article;
    /**
     * @ORM\Column(type="string")
     */
    private $title_article;
    /**
     * @ORM\Column(type="string")
     */
    private $content_article;
    /**
     * @ORM\Column(type="string")
     */
    private $views_number;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_of_publish;

    /**
     * @ORM\ManyToOne(targetEntity="domain")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id_domain")
     */
    private $domain;

    /**
     * @ORM\ManyToOne(targetEntity="newsletter")
     * @ORM\JoinColumn(name="newsletter_id", referencedColumnName="id_newsletter")
     */
    private $newsletter;

    public function getId_Article()
    {
        return $this->id_article;
    }

    public function setId_Article($id_article)
    {
        $this->id_article = $id_article;
    }

    public function getTitle_Article()
    {
        return $this->title_article;
    }

    public function setTitle_Article($title_article)
    {
        $this->title_article = $title_article;
    }

    public function getContent_Article()
    {
        return $this->content_article;
    }

    public function setContent_Article($content_article)
    {
        $this->content_article = $content_article;
    }

    public function getViews_Number()
    {
        return $this->views_number;
    }

    public function setViews_Number($views_number)
    {
        $this->views_number = $views_number;
    }

    public function getDate_Of_Publish()
    {
        return $this->date_of_publish;
    }

    public function setDate_Of_Publish($date_of_publish)
    {
        $this->date_of_publish = $date_of_publish;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getNewsletter()
    {
        return $this->newsletter;
    }

    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $image;

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }


}