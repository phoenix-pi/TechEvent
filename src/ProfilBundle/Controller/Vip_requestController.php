<?php

namespace ProfilBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use TechEventBundle\Entity\User;
use TechEventBundle\Entity\Vip_request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class Vip_requestController extends Controller
{
    public function sendAction(Request $request)
    {




        $vip_request= new Vip_request();
        $form = $this->createFormBuilder($vip_request)
            ->add('content_request', TextareaType::class,['label' => false])
            ->add('devisFile', VichImageType::class,['label' => false])
            ->add('save', SubmitType::class,['label' => 'Send Request'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $vip_request = $form->getData();

            $user = $this->getUser();
            $vip_request->setUser($user);
            $vip_request->setStatus('pending');
            $vip_request->setCreation_Date(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vip_request);
            $entityManager->flush();

        }
        return $this->render('@Profil/request/request.html.twig',['form'=>$form->createView()]);



    }

    public function indexAction()
    {
        $requests = $this->getDoctrine()->getRepository(Vip_request::class)->findBy(['status'=>'pending']);
        return $this->render('@Profil/request/index.html.twig',array(
            'requests'=>$requests
        ));

    }

    public function checkAction($id)
    {
        $request = $this->getDoctrine()->getRepository(Vip_request::class)->findOneBy(['id_request'=>$id]);
        return $this->render('@Profil/request/check.html.twig',array(
            'request'=>$request
        ));

    }

    public function acceptAction(Request $request,$idreq,$idus)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $em->getRepository(Vip_request::class)->find($idreq);
        $user = $em->getRepository(User::class)->find($idus);

        if ($request->isMethod('POST'))
        {

            $req->setStatus($request->get('status'));

            if ($request->get('status')=='Accepted')
            {

                $user->setStatus('VIP');
            }
            $em->flush();
        }
        return $this->redirectToRoute('tech_event_requests_list');





    }




}

