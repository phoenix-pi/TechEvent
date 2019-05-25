<?php

namespace ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\Workshop;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Club/Default/index.html.twig');
    }

    /*public function particpeAction($id_w){
        //id Workshop $w
        //Id user
        $em=$this->getDoctrine()->getManager();
        $workshop=$em->getRepository(Workshop::class)->find($id_w);
        if($workshop->getNbr_Places()>0)
        $workshop->setNbr_Places($workshop->getNbr_Places()-1);
        $em->flush;}
    else //msg
        return $this->redirectToRoute('')
    }*/
}
