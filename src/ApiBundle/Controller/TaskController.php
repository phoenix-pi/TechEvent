<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\httpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use TechEventBundle\Entity\Comment;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\Task;
use TechEventBundle\Entity\User;
use TechEventBundle\Entity\Report;

class TaskController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritApiBundle:Default:index.html.twig');
    }

    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(Comment::class)
            ->findAll();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($tasks);
        return new JsonResponse($formatted);

    }


    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(Comment::class)
            ->find($id);
        $serializer = new serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);


    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new task();
        $task->setName($request->get('name'));
        $task->setStatus($request->get('status'));
        $em->persist($task);
        $em->flush();
        $serializer = new serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($task);
        return new JsonResponse($formated);
    }


    public function AddAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $user = $this->getDoctrine()->getRepository(User::class)->find((int)$request->get('iduser'));
        $event = $this->getDoctrine()->getRepository(Event::class)->find((int)$request->get('idevent'));
        $comment->setUser($user);
        $comment->setEvent($event);
        $comment->setDateofcomment(new \DateTime('now'));
        $comment->setContent($request->get('comment'));
        $comment->setNbrep(0);

        $em->persist($comment);
        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($comment);
        return new JsonResponse($formatted);

    }


    public function afficherAction($idevent)
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->findBy(['event' => $idevent]);
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($comment);
        return new JsonResponse($formatted);

    }


    public function allCommentAction()
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->findAll();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($comment);
        return new JsonResponse($formatted);

    }


    public function allEventAction()
    {
        $comment = $this->getDoctrine()->getRepository(Event::class)->findAll();

        $serializer = new serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($comment);
        return new JsonResponse($formated);

    }


    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        $em->remove($comment);
        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($comment);
        return new JsonResponse($formatted);

    }

    public function updateAction(Request $request, $id, $content)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(Comment::class)->find($id);

        $comment->setDateofcomment(new \DateTime('now'));
        $comment->setContent($content);

        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($comment);
        return new JsonResponse($formatted);


    }

    /*  public function reportAction($id) {
          $em = $this->getDoctrine()->getManager();
          $comment=$this->getDoctrine()->getRepository(Comment::class)->findOneBy(['id_comment'=>$id]);
          $comment->setnbrep($comment->getnbrep()+1);
          $em->flush();

          $report = new Report();
          $report->setUser($comment->getuser());
          $report->setComment($comment);
          $em->persist($report);
          $em->flush();

          $serializer = new serializer([new ObjectNormalizer()]);
          $formated = $serializer->normalize($comment);
          return new JsonResponse($formated);
      }*/


}



