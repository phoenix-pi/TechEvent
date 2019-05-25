<?php

namespace CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TechEventBundle\Entity\Cart;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\Order_line;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Ticket;

class APIController extends Controller
{

    public function allAction()
    {


        $user=$this->getUser();
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user_cart'=>$user]);
        $lineCart= $this->getDoctrine()->getRepository(Order_line::class)->findBy(['line_cart'=>$cart]);

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getIdLine();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);


        $formatted=$serializer->normalize($lineCart);
        return new JsonResponse($formatted);
    }
    public function allEventAction()
    {
        $cart = $this->getDoctrine()->getRepository(Event::class)->findAll();


        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);


        $formatted=$serializer->normalize($cart);
        return new JsonResponse($formatted);
    }

    public function allTicketAction()
    {
        $cart = $this->getDoctrine()->getRepository(Ticket::class)->findAll();


        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);


        $formatted=$serializer->normalize($cart);
        return new JsonResponse($formatted);
    }
    public function findEventAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('TechEventBundle:Event')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
//


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new Ticket();
        $user = $this->getDoctrine()->getManager()
            ->getRepository('TechEventBundle:User')
            ->find($request->get('user_id'));
        $task->setUser_Ticket($user);
        $task->setTime_Booked(new\DateTime('now'));
        $event=$this->getDoctrine()->getManager()
            ->getRepository('TechEventBundle:Event')
            ->find($request->get('event'));
        $task->setEvent_Ticket($event);
        $task->setStatus($request->get('status'));
      $task->setCode('252');
       $task->setQrCode('jhkhkhkh');
        $em->persist($task);
        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($tasks) {
            return $tasks;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($task);
        return new JsonResponse($formatted);
    }




    public function DeleteTicketAction($idt)
    {
        $em = $this->getDoctrine()->getManager();

        $ticket = $em->getRepository(Ticket::class)->find($idt);

        $ticket->setStatus(true);
        $em->flush();

        return $this->redirectToRoute('show_cart');

    }



}
