<?php

namespace CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;
use TechEventBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\User;
use TechEventBundle\Form\CommentType;

class CommentController extends Controller
{


    public function showAction($id)

    {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['event'=>$id]);
        $event= $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('@Comment/comment/show.html.twig', array(
            'comment' =>$comments,
            'e'=>$event
        ));
    }


    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $comments =$this->getDoctrine()->getRepository(Comment::class)->find($id);
        $em->remove($comments);
        $em->flush();
        return $this->redirectToRoute('comment_comment_show', array('id' => $comments->getEvent()->getId_event()));

    }

    public function getCommentAction($id) {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['event'=>$id]);
        return $this->render('@Comment/comment/show.html.twig', array('comment' =>$comments));
    }

    public function  add2Action (Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $event =$em->getRepository(Event::class)->find($id);

        if ($request->isMethod('post')) {
            $comment= new Comment();
            $currentuser=$this->getUser();
            $comment->setUser($currentuser);
            $comment->setEvent($event);
            $comment->setDateofcomment(new \DateTime('now'));
            $comment->setContent($request->get('comment'));
            $comment->setNbrep(0);

            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('comment_comment_show', array('id' => $event->getId_event()));

        }

    }
    public function updateAction(Request $request ,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(Comment::class)->find($id);
        if ($request->isMethod('post')) {

            $comment->setDateofcomment(new \DateTime('now'));
            $comment->setContent($request->get('comment'));

            $em->flush();


        }
        return $this->redirectToRoute('comment_comment_show', array('id' => $comment->getEvent()->getId_event()));
    }



}
