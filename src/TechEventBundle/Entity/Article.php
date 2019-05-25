<?php

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\ArticleRepository")
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idArticle;
    /**
     * @ORM\Column(type="string")
     */
    private $titleArticle;
    /**
     * @ORM\Column(type="text")
     */
    private $contentArticle;
    /**
     * @ORM\Column(type="integer")
     */
    private $viewsNumber;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateOfPublish;

    /**
     * @ORM\ManyToOne(targetEntity="Domain")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id_domain", onDelete="CASCADE")
     */
    private $domain;

    /**
     * @ORM\ManyToOne(targetEntity="Newsletter")
     * @ORM\JoinColumn(name="newsletter_id", referencedColumnName="id_newsletter", onDelete="CASCADE")
     */
    private $newsletter;

    public function getIdArticle()
    {
        return $this->idArticle;
    }

    public function setIdArticle($id_article)
    {
        $this->idArticle = $id_article;
    }

    public function getTitleArticle()
    {
        return $this->titleArticle;
    }

    public function setTitleArticle($title_article)
    {
        $this->titleArticle = $title_article;
    }

    public function getContentArticle()
    {
        return $this->contentArticle;
    }

    public function setContentArticle($content_article)
    {
        $this->contentArticle = $content_article;
    }

    public function getViewsNumber()
    {
        return $this->viewsNumber;
    }

    public function setViewsNumber($views_number)
    {
        $this->viewsNumber = $views_number;
    }

    public function getDateOfPublish()
    {
        return $this->dateOfPublish;
    }

    public function setDateOfPublish($date_of_publish)
    {
        $this->dateOfPublish = $date_of_publish;
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="add an image jpg")
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png" })
     * @Assert\File(maxSize = "32768k")
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