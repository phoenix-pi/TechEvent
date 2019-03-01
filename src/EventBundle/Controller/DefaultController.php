<?php

namespace EventBundle\Controller;

use EventBundle\EventBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\Event;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $event = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('@Event/Default/index.html.twig', array('e' => $event));

    }
}
