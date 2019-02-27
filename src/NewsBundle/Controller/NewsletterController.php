<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\Article;
use TechEventBundle\Entity\Domain;
use TechEventBundle\Entity\Newsletter;
use TechEventBundle\Entity\Newsletter_Subscriber;
use TechEventBundle\Entity\Subscriber;

class NewsletterController extends Controller
{
    public function createAction()
    {
        $success=false;
        $subscribers=$this->getDoctrine()->getRepository(Subscriber::class)->findAll();
        $domains=$this->getDoctrine()->getRepository(Domain::class)->findAll();
        foreach ($domains as $d) {
            $articles_by_domain=$this->getDoctrine()->getRepository(Article::class)->getArticleByDomain($d);
            if (sizeof($articles_by_domain)>0) {
                $newsletter = new Newsletter();
                $newsletter->setCreation_Date(new \DateTime());
                $em=$this->getDoctrine()->getManager();
                $em->persist($newsletter);
                $em->flush();
                foreach ($subscribers as $s) {
                    if($s->getDomain() == $d) {
                        $this->sendEmail($s, $articles_by_domain, $newsletter);
                        $ns = new Newsletter_Subscriber();
                        $ns->setNewsletter($newsletter);
                        $ns->setSubscriber($s);
                        $em->persist($ns);
                        $em->flush();
                    }
                }
                foreach ($articles_by_domain as $abd) {
                    $abd->setNewsletter($newsletter);
                    $em->persist($abd);
                    $em->flush();
                }
                $success=true;
            }
        }
        return $this->render('@News/Default/success.html.twig', array(
            's'=>$success
        ));
    }


    public function sendEmail($sub, $articlesToSend, $newsletter) {
        $message = (new \Swift_Message('Newsletter'))
            ->setFrom('pi.phoenix.2019@gmail.com')
            ->setTo($sub->getEmail_subscriber())
            ->setBody(
                $this->renderView(
                    '@News/Subscribe/emails/newsletter.html.twig', array(
                        'sub'=>$sub,
                        'articles'=>$articlesToSend,
                        'newsletter'=>$newsletter
                    )
                ),
                'text/html'
            ) ;

        $this->get('mailer')->send($message);
    }
}
