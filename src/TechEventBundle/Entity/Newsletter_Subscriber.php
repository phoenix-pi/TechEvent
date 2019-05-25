<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 18/02/2019
 * Time: 16:55
 */

namespace TechEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="newsletter_subscriber")
 */
class Newsletter_Subscriber
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_newsletter_subscriber;

    /**
     * @ORM\ManyToOne(targetEntity="newsletter")
     * @ORM\JoinColumn(name="newsletter_id", referencedColumnName="id_newsletter", onDelete="CASCADE")
     */
    private $newsletter;

    /**
     * @ORM\ManyToOne(targetEntity="subscriber")
     * @ORM\JoinColumn(name="subscriber_id", referencedColumnName="id_subscriber", onDelete="CASCADE",)
     *
     */
    private $subscriber;

    public function getId_Newsletter_Subscriber()
    {
        return $this->id_newsletter_subscriber;
    }

    public function setId_Newsletter_Subscriber($id_newsletter_subscriber)
    {
        $this->id_newsletter_subscriber = $id_newsletter_subscriber;
    }

    public function getNewsletter()
    {
        return $this->newsletter;
    }

    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function getSubscriber()
    {
        return $this->subscriber;
    }


    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
    }

}