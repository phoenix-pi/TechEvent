<?php

namespace TechEventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('@TechEvent/Default/index.html.twig');
    }

    public function UserRedirectAction()
    {
        return $this->render('@TechEvent/Default/hello-world.html.twig');
    }

    public function AdminRedirectAction()
    {
        return $this->render('@TechEvent/admin-cfg/admin-dashboard.html.twig');
    }
}
