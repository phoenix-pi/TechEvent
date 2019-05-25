<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 18/02/2019
 * Time: 16:07
 */

namespace TechEventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CommentBundle\Repository\ReoprtRepository")
 * @ORM\Table(name="report")
 */
class Report
{
    /**
     *  @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id_report;


    public function getIdReport()
    {
        return $this->id_report;
    }

    public function setIdReport($id_report)
    {
        $this->id_report = $id_report;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Comment"))
     * @ORM\JoinColumn(name="comment_id",referencedColumnName="id_comment",onDelete="CASCADE")
     */
    private $comment;


    /**
     * @ORM\ManyToOne(targetEntity="User"))
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_report_comment;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_report_user;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private  $date_of_report;



}