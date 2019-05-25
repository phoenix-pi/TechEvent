<?php

namespace CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\Blacklist;
use TechEventBundle\Entity\Comment;
use TechEventBundle\Entity\Report;
use TechEventBundle\Entity\User;

class ReportController extends Controller
{


    public function reportAction($id) {
        $em = $this->getDoctrine()->getManager();
        $comment=$this->getDoctrine()->getRepository(Comment::class)->findOneBy(['id_comment'=>$id]);
        $comment->setnbrep($comment->getnbrep()+1);
        $em->flush();

        $report = new Report();
        $report->setUser($comment->getuser());
        $report->setComment($comment);
        $em->persist($report);
        $em->flush();
        return $this->redirectToRoute('comment_comment_show', array('id' => $comment->getEvent()->getId_event()));
    }


    public function AffichlistAction(){

        $comment=$this->getDoctrine()->getRepository(Comment::class)->findAll();
        $report=$this->getDoctrine()->getRepository(Comment::class)->findAll();
        $maxComment=array();
        $indexmax=0;



        foreach ($comment as $max) {

            if ($max->getnbrep() > 2) {
                $maxComment[$indexmax] = $max;
                $indexmax++;

            }

        }

        return $this->render('@Comment/comment/report.html.twig',['com'=>$maxComment]);
    }



    public function deleteReportAction($id){
        $em = $this->getDoctrine()->getManager();
        $comments =$this->getDoctrine()->getRepository(Comment::class)->find($id);
        $em->remove($comments);
        $em->flush();
        return $this->redirectToRoute('comment_reportAdmin');

    }
    public function AffichBlacklistAction(){
        $em = $this->getDoctrine()->getManager();
        $listuser=$this->getDoctrine()->getRepository(User::class)->findAll();

        foreach($listuser as $user)    {

            $reportuser=$this->getDoctrine()->getRepository(Report::class)->countuser(['user'=>$user]);




            if(sizeof($reportuser) > 3){

                $blacklist= new Blacklist();
                $blacklist->setUser($user);
                $em->persist($blacklist);
                $em->flush();
            }
        }

        $listuser=$this->getDoctrine()->getRepository(Blacklist::class)->findAll();
        return $this->render('@Comment/comment/blacklist.html.twig',['list'=>$listuser]);

    }



}

