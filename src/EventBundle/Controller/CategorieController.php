<?php

namespace EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TechEventBundle\Entity\Category;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\user_categorie;


class CategorieController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Event/Event/Adminevent.html.twig');
    }


    public function CategorieAfficheAction()
    {
        $categorie = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('@Event/Event/AdminCategorie.html.twig', array('category' => $categorie));
    }

    public function CategorieAddAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $categorie = new Category();
            if($request->get('name') != null){
            $categorie->setCategory_Name($request->get('name'));
            $em->persist($categorie);
            $em->flush();
            }
        }
            return $this->redirectToRoute('event_AdminEventCategorie');
    }


    public function CategorieupdateAction(Request $request,$id)
    {
        $category= $this->getDoctrine()->getRepository(Category::class)->find($id);

              if ($request->isMethod('POST')) {
                    $em = $this->getDoctrine()->getManager();
                    $category->setCategory_Name($request->get('name'));
                    $em->persist($category);
                    $em->flush();

              }

             return $this->redirectToRoute('event_AdminEventCategorie');

    }




    public function CategoriedeleteAction($id)
    {
         $em= $this->getDoctrine()->getManager();
        $categorie= $this->getDoctrine()->getRepository(Category::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('event_AdminEventCategorie');
    }



    public function UserCategoryAction()
    {

        $user=$this->getUser();
        $cat= $this->getDoctrine()->getRepository(Category::class)->findAll();



        $eventlist=array();
        $index=0;
        $Catlist=array();
        $indexCat=0;

        $categories = $this->getDoctrine()->getRepository(user_categorie::class)->findBy(['id_user'=>$user]);

        foreach ($categories as $category) {
            $event = $this->getDoctrine()->getRepository(Event::class)->findBy(['category' => $category->getIdCategory()]);
            $eventlist[$index] = $event;
            $index++;
            $Catlist[$indexCat]=$category->getIdCategory();
            $indexCat++;

        }


        return $this->render('@Event/Event/userCategorie.html.twig', ['event' => $eventlist,'category'=>$cat,'myCat'=>$Catlist]);
    }



        function  CategorieLikeAction(Category $id){

            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository(user_categorie::class);


            $user = $this->getUser();

            $catLiked = $repo->findOneBy(['id_category' => $id, 'id_user' => $user]);

            if ($catLiked != null) {
                $em->remove($catLiked);
                $em->flush();
                $em->flush();

            } else {
                $catLiked = new user_categorie();
                $catLiked->setIdUser($user);
                $catLiked->setIdCategory($id);
                $em->persist($catLiked);
                $em->flush();

            }

          return  $this->redirectToRoute('event_UserCategorie');

        }






}
