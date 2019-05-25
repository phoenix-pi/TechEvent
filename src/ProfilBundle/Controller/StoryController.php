<?php

namespace ProfilBundle\Controller;

use TechEventBundle\Entity\Story;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\User;
use TechEventBundle\Entity\User_Story;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class StoryController extends Controller
{

    public function indexAction($id)
    {

        $user = $this->getDoctrine()->getRepository(User::class)->findBy(['id' =>$id]);
        $stories = $this->getDoctrine()->getRepository(Story::class)->findBy(['user' =>$id],['creation_date' => 'DESC']);
        $sharer = $this->getDoctrine()->getRepository(User_Story::class)->findS($id);
        $gg = array_column($sharer,'story_id');
        $shared = $this->getDoctrine()->getRepository(Story::class)->findBy(['id_story' =>$gg],['creation_date' => 'DESC']);
        return $this->render('@Profil/default/index.html.twig',array(
            'stories'=>$stories,'id'=>$id,'user'=>$user,'shared'=>$shared
        ));

    }

    public function publishAction(Request $request,$id)
    {

        if($request->isMethod('POST')) {
            $story = new Story();
            $user = $this->getUser();
            $story->setContent_Story($request->get('content'));
            $story->setCreation_Date(new \DateTime('now'));
            $story->setUser($user);
            $em=$this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();
        }
        return $this->redirectToRoute('profil_homepage', ['id'=>$id]);


    }


    public function publishmobAction($id,$content)
    {

        $story = new Story();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $story->setContent_Story($content);
        $story->setCreation_Date(new \DateTime('now'));
        $story->setUser($user);
        $em=$this->getDoctrine()->getManager();
        $em->persist($story);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($story);
        return new JsonResponse($formatted);

    }












    public function indexmobAction($id)
    {




        $stories = $this->getDoctrine()->getRepository(Story::class)->findBy(['user' =>$id],['creation_date' => 'DESC']);

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($stories);
        return new JsonResponse($formatted);


    }









}
