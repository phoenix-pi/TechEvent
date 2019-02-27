<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Domain;
use TechEventBundle\Entity\Subscriber;

class SubscribeController extends Controller
{
    public function subscribeAction(Request $request)
    {
        $exist=0;
        if ($request->isMethod('post')) {
            $email=$request->get('email');
            if (0!=sizeof($this->getDoctrine()->getRepository(Subscriber::class)->findSubByEmail($email))) {
                $exist=1;
            } else {
                $domain=$this->getDoctrine()->getRepository(Domain::class)->find($request->get('domain_id'));
                $sub=new Subscriber();
                $sub->setDomain($domain);
                $sub->setEmail_Subscriber($email);
                $em=$this->getDoctrine()->getManager();
                $em->persist($sub);
                $em->flush();

                $message = (new \Swift_Message('Welcome to our newsletter'))
                    ->setFrom('pi.phoenix.2019@gmail.com')
                    ->setTo($email)
                    ->setSubject("Welcome to the newsletter.")
                    ->setBody(
                        $this->renderView(
                            '@News/Subscribe/emails/welcome.html.twig', array(
                            'sub'=>$sub
                            )
                        ),
                    'text/html'
                    ) ;

                $this->get('mailer')->send($message);

                return $this->render('@News/Subscribe/subscribe.html.twig', array(
                    'confirm'=>1
                ));
            }
        }
        $domains=$this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Subscribe/subscribe.html.twig', array(
            'domains'=>$domains,
            'exist'=> $exist
        ));
    }


    public function getAllAction() {
        $subs=$this->getDoctrine()->getRepository(Subscriber::class)->findAll();
        return $this->render('@News/Subscribe/all.html.twig', array(
            'subs'=>$subs
        ));
    }

    public function removeAction($id) {
        $sub=$this->getDoctrine()->getRepository(Subscriber::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($sub);
        $em->flush();
        $subs=$this->getDoctrine()->getRepository(Subscriber::class)->findAll();
        return $this->render('@News/Subscribe/all.html.twig', array(
            'subs'=>$subs
        ));
    }

    public function searchAction(Request $request) {
        $subs=$this->getDoctrine()->getRepository(Subscriber::class)->findSubByEmail($request->get('email'));
        return $this->render('@News/Subscribe/all.html.twig', array(
            'subs'=>$subs
        ));
    }

    public function removeVisitorAction($id) {
        $sub=$this->getDoctrine()->getRepository(Subscriber::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($sub);
        $em->flush();
        return $this->render('@News/Subscribe/emails/unsubscribe.html.twig');
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sub = $em->getRepository(Subscriber::class)->find($id);
        if ($request->isMethod('POST')) {
            $sub->setEmail_Subscriber($request->get('email'));
            $domain=$this->getDoctrine()->getRepository(Domain::class)->find($request->get('domain_id'));
            $sub->setDomain($domain);
            $em->flush();
            return $this->render('@News/Subscribe/updateSub.html.twig', array(
                'confirm'=>1
            ));
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Subscribe/updateSub.html.twig',array(
            'sub' => $sub,
            'domains'=>$domains
        ));
    }
}
