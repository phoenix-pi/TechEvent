<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Domain;

class DomainController extends Controller
{
    public function indexAction(Request $request)
    {
        if($request->isMethod('POST')) {
            $domain = new Domain();
            $domain->setName_Domain($request->get('nom'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($domain);
            $em->flush();
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Domain/index.html.twig',array(
            'domains'=>$domains
        ));
    }

    public function deleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $domain_del=$em->getRepository(Domain::class)->find($id);
        if ($request->isMethod('POST')) {
            $em->remove($domain_del);
            $em->flush();
            return $this->redirectToRoute("news_domain_homepage");
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Domain/index.html.twig',array(
            'domain_del' => $domain_del,
            'domains'=>$domains
        ));
    }

    public function updateAction(Request $request, $id) //
    {
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository(Domain::class)->find($id);
        if ($request->isMethod('POST')) {
            $domain->setName_Domain($request->get('nom'));
            $em->flush();
            return $this->redirectToRoute('news_domain_homepage');
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Domain/index.html.twig',array(
            'domain' => $domain,
            'domains'=>$domains
        ));
    }

    public function searchAction(Request $request) {
        if ($request->isMethod('post')) {
            $domains = $this->getDoctrine()->getRepository(Domain::class)->findDomainByName($request->get('query'));
        }
        return $this->render('@News/Domain/index.html.twig',array(
            'domains'=>$domains
        ));
    }

}
