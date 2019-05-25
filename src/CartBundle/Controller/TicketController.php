<?php

namespace CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TechEventBundle\Entity\Order_line;
use TechEventBundle\Entity\Ticket;


class TicketController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Cart/Cart/cart.html.twig');
    }

    public function ShowTicketAction()
    {
        $ticket = $this->getDoctrine()->getRepository(Ticket::class)->findAll();

        return $this->render('@Cart/Cart/cart.html.twig', array('t' => $ticket));
    }

//    public function UpdateTicketAction($idt)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $ticket = $em->getRepository(Ticket::class)->find($idt);
//
//        $ticket->setStatus(true);
//        $em->flush();
//
//        return $this->render('@Cart/Cart/cart.html.twig', array('t' => $ticket));
//    }

    public function UpdateQuantityAction(Request $request, Order_line $order_line, $quantity)
    {
        $order_line->setQuantity($quantity);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return new Response("Updated quantity to $quantity");

    }


}
