<?php

namespace ProfilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
class UserController extends Controller
{
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('@Profil/User/index.html.twig',array(
            'users'=>$users
        ));

    }

    public function banAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        if ($request->isMethod('POST'))
        {

            $user->setStatus($request->get('status'));
            $em->flush();
            if($request->get('status') == "Banned")
            {
              $user->setEnabled(0);
                $em->flush();
            }
            else {
                $user->setEnabled(1);$em->flush();
            }
            if($request->get('status') == "Admin")
            {
                $user->addRole("ROLE_ADMIN");
                $em->flush();

            }
            else {
                $user->removeRole("ROLE_ADMIN");

                $em->flush();
            }

        }
        return $this->redirectToRoute('tech_event_members_list');


    }
}
