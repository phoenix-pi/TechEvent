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
 * @ORM\Entity
 * @ORM\Table(name="report")
 */
class Report
{
    /**
     *  @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id_report;
    /**
     * @ORM\Column(type="integer")
     */private $nb_report_comment;
    /**
     * @ORM\Column(type="integer")
     */private $nb_report_user;

    public function getIdReport()
    {
        return $this->id_report;
    }

    public function setIdReport($id_report)
    {
        $this->id_report = $id_report;
    }

    public function getNbReportComment()
    {
        return $this->nb_report_comment;
    }

    public function setNbReportComment($nb_report_comment)
    {
        $this->nb_report_comment = $nb_report_comment;
    }

    public function getNbReportUser()
    {
        return $this->nb_report_user;
    }

    public function setNbReportUser($nb_report_user)
    {
        $this->nb_report_user = $nb_report_user;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Comment"))
     * @ORM\JoinColumn(name="comment_id",referencedColumnName="id_comment")
     */
    private $comment;

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_of_report;

    public function getDate_Of_Report()
    {
        return $this->date_of_report;
    }

    public function setDate_Of_Report($date_of_report)
    {
        $this->date_of_report = $date_of_report;
    }




}