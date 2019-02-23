<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/22/2019
 * Time: 2:47 PM
 */

namespace ClubBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Workshop;

class WorkshopController extends Controller
{
    public function createWorkshopAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod('post')){
            $work = new Workshop();
            $work->setTitle($request->get('Title'));
            $work->setWorkshop_Description($request->get('Description'));
            $work->setLocation($request->get('location'));
            $work->setNbr_Places($request->get('nbr'));
            $work->setStart_Date(new \DateTime($request->get('date')) );
            $em->persist($work);
            $em->flush();

        }
        return $this->render('@Club/Workshop/AddWorkshop.html.twig');
    }
    public function upWorkshopAction(Request $request)
    {
        $work = $this->getDoctrine()->getRepository(Workshop::class)->findAll();
        return $this->render('@Club/Workshop/Affiche.html.twig',array('wo'=>$work));
    }
    public function particpeAction($id){
        $work = $this->getDoctrine()->getRepository(Workshop::class)->findAll();
        $em=$this->getDoctrine()->getManager();
        $workshop=$this->getDoctrine()->getRepository(Workshop::class)->find($id);
        if($workshop->getNbr_Places()>0){
        $workshop->setNbr_Places($workshop->getNbr_Places()-1);
        $em->persist($workshop);
        $em->flush();
    }

        return $this->render('@Club/Workshop/Affiche.html.twig',array('wo'=>$work));
    }

}