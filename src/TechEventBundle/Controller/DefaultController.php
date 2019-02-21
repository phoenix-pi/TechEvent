<?php

namespace TechEventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
