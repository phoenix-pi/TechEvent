<?php

namespace CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use TechEventBundle\Entity\Cart;
use TechEventBundle\Entity\Order_line;


class CartController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Cart/Cart/cart.html.twig');
    }

    public function ShowCartAction()
    {
        $user=$this->getUser();
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user_cart'=>$user]);
        $lineCart= $this->getDoctrine()->getRepository(Order_line::class)->findBy(['line_cart'=>$cart]);

        $totalPrice = 0;
        foreach ($lineCart as $line) {
            $quantity = 1;
            if ($line->getQuantity() != null)
                $quantity = $line->getQuantity();

            $totalPrice += $quantity * $line->getLine_Ticket()->getEvent_Ticket()->getPriceTicket();}
        return $this->render('@Cart/Cart/showcart.html.twig', array('l' => $lineCart,'totalPrice' => $totalPrice));

    }

}
