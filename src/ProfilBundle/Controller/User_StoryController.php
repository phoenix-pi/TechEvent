<?php

namespace ProfilBundle\Controller;

use TechEventBundle\Entity\Story;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\User;
use TechEventBundle\Entity\User_Story;
class User_StoryController extends Controller
{


    public function shareAction(Request $request,$iduser,$idstory)
    {

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' =>$iduser]);
        $story = $this->getDoctrine()->getRepository(Story::class)->findOneBy(['id_story' =>$idstory]);
        if($request->isMethod('POST')) {
            $shared = new User_Story();
            $shared->setId_Story($story);
            $shared->setId_User($user);
            $shared->setCreation_Date(new \DateTime('now'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($shared);
            $em->flush();
        }
        return $this->redirectToRoute('profil_homepage', ['id'=>$iduser]);







    }


}
