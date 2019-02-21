<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function notAllowedAction()
    {
        return $this->render('@News/Default/index.html.twig');
    }
}
