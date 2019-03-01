<?php

namespace TechEventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@TechEvent/Default/index.html.twig');
    }

    public function testRoleUserAction()
    {
        return $this->render('@TechEvent/Default/hello-world.html.twig');
    }

    public function testRoleAdminAction()
    {
        return $this->render('@TechEvent/Default/hello-world-admin.html.twig');
    }

    public function snappyAction() {
        $snappy = $this->get('knp_snappy.pdf');
        $html = $this->renderView('@TechEvent/Default/hello.html.twig');
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
