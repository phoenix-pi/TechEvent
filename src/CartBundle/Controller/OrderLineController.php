<?php

namespace CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TechEventBundle\Entity\Cart;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\Order_line;
use TechEventBundle\Entity\Ticket;


class OrderLineController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Cart/Cart/cart.html.twig');
    }

    public function ShowLineAction()
    {


        /** @var Order_line[] $lines */
        $lines = $this->getDoctrine()->getRepository(Order_line::class)->findAll();


        $totalPrice = 0;
        foreach ($lines as $line) {
            $quantity = 1;
            if ($line->getQuantity() != null)
                $quantity = $line->getQuantity();

            $totalPrice += $quantity * $line->getLine_Ticket()->getEvent_Ticket()->getPriceTicket();
        }
        return $this->render('@Cart/Cart/showcart.html.twig', array('l' => $lines, 'totalPrice' => $totalPrice));
    }

    public function lineCountAction()
    {
        $user=$this->getUser();
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user_cart'=>$user]);
        $lineCart= $this->getDoctrine()->getRepository(Order_line::class)->findBy(['line_cart'=>$cart]);
        return new Response(count($lineCart));
    }


    public function AddTicketAction(Request $req, Event $event)
    {

        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $cart= $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user_cart'=>$user]);
        $qticket= $this->getDoctrine()->getRepository(Ticket::class)->findBy(['event_ticket'=>$event,'status'=>false]);
        $nb= sizeof($qticket);


        $quantity = $event->getNb_Participant();


        if ($req->isMethod('post')) {

            if($quantity - $nb != 0)
            {

                $ticket = new Ticket();
                $user = $this->getUser();
                $ticket->setUser_Ticket($user);
                $ticket->setEvent_Ticket($event);
                $ticket->setTime_Booked(new\DateTime('now'));
                $ticket->setStatus(false);
                $em->persist($ticket);
                $em->flush();


                if ($cart == null) {


                    $cart = new Cart();
                    $cartuser = $this->getUser();
                    $cart->setUser_Cart($cartuser);
                    $cart->setTotal(0);
                    $em->persist($cart);
                    $em->flush();

                    $line = new Order_line();
                    $line->setLine_Ticket($ticket);
                    $line->setLine_Cart($cart);
                    $p = $event->getPriceTicket();
                    $line->setPrice($p);
                    $em->persist($line);
                    $em->flush();
                    $this->send($event,$this->getUser());
                } else {
                    $line = new Order_line();
                    $line->setLine_Ticket($ticket);
                    $line->setLine_Cart($cart);
                    $p = $event->getPriceTicket();
                    $line->setPrice($p);
                    $em->persist($line);
                    $em->flush();
                    $this->send($event,$this->getUser());
                }

            return $this->redirectToRoute('show_cart');
        }
        else
        {
            return $this->redirectToRoute('show_cart');
        }
        }
    }


    public function send($to, $user){
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('pi.phoenix.2019@gmail.com')
            ->setTo($to->getOrganizer()->getEmail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    '@Cart/Cart/notiforgenizer.html.twig',
                    array(
                        'user'=>$user,
                        'event'=>$to
                    )
                ),
                'text/html'
            )
        ;

        $this->get('mailer')->send($message);
    }


    public function DeleteTicketAction( Request $request,$id, Order_line $tick)
    {
        $em = $this->getDoctrine()->getManager();

        $line = $em->getRepository(Order_line::class)->find($id);
        $idt = $tick->getLine_Ticket();
        $ticket = $em->getRepository(Ticket::class)->find($idt);

        $ticket->setStatus(true);
        $em->flush();

        $idevent= $ticket->getEvent_Ticket();
        $event = $this->getDoctrine()->getRepository(Event::class)->findOneBy(['id_event'=>$idevent]);
        $datevent= $event->getStart_Date();
        $curentdate= new\DateTime('now');
        $datevent2 = date_modify($datevent,'-3 day');

        $session = $this->container->get('session');
        if ($datevent2 <= $curentdate)
        {
            $session->getFlashBag()->add(
                'notice',
                'you cant cancel ticket before 2 days of the event!');

            return $this->redirectToRoute('show_cart');
        }
        else{

        $em->remove($line);
        $em->flush();

        return $this->redirectToRoute('show_cart');
        }
    }
    function SendTicketAction()
    {

//        $lineCart= $this->getDoctrine()->getRepository(Order_line::class)->findAll();
        $user=$this->getUser();
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user_cart'=>$user]);
        $lineCart= $this->getDoctrine()->getRepository(Order_line::class)->findBy(['line_cart'=>$cart]);

        $totalPrice = 0;
        foreach ($lineCart as $line) {
            $quantity = 1;
            if ($line->getQuantity() != null)
                $quantity = $line->getQuantity();

            $totalPrice += $quantity * $line->getLine_Ticket()->getEvent_Ticket()->getPriceTicket();}

        $html= $this->render('@Cart/Cart/showticket.html.twig', array('l' => $lineCart,'totalPrice' => $totalPrice));

        $snappy = $this->get('knp_snappy.pdf');
        $filename='snappy';
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'  =>  'application/pdf',
                'Content-Disposition'   =>  'inline; filename="'.$filename.'pdf"'
            )
        );

    }


}