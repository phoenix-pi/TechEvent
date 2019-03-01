<?php

namespace EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TechEventBundle\Entity\Category;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\Event_likes;
use TechEventBundle\Entity\User;

class EventController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Event/Event/Event.html.twig');
    }


    public function AfficheAction()
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        foreach ($events as $event) {

            $isEventLiked = $this->getDoctrine()
                ->getRepository(Event_likes::class)
                ->findOneBy(['event' => $event, 'user' => $this->getUser()]);

            if ($isEventLiked == null)
                $event->setIsLiked(false);
            else
                $event->setIsLiked(true);

        }
        return $this->render('@Event/Event/Event.html.twig', array('e' => $events));
    }


    public function AddeventAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('@Event/Event/Add.html.twig', ['categories' => $categories]);
    }

    public function AddEventDataAction(Request $request)
    {

        if ($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();

            $event = new Event();

            $event->setEvent_Name($request->get('eventName'));
            $event->setAddress($request->get('address'));
            $event->setNb_Participant($request->get('nb'));
            $idCategory = $request->get('categorie');
            $category = $em->find(Category::class, $idCategory);

           $file = $request->files->get('photo');

            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('img_directory') , $filename);
            $event->setPhoto($filename);
            $price = $request->get('price');

            $event->setCategory($category);
            $event->setDescription($request->get('description'));
            $event->setPriceTicket($price);
            $event->setArchive(false);
            $event->setStart_Date(new \DateTime($request->get('startDate')));
            $event->setEnd_Date(new \DateTime($request->get('endDate')));
            $event->setNbLike(0);


            /** @var User $user */
            $user = $this->getUser();

            $event->setOrganizer($user);
            if ($user != null) {
                if ($user->getStatus() == 'VIP') {
                    $event->setStatus("ACCEPTED");
                } else {
                    $event->setStatus("WAITING");
                }
            } else {
                $event->setStatus("WAITING");
            }

            $em->persist($event);
            $em->flush();
        }
        return $this->redirectToRoute('event_homeAffiche');
    }


    public function AffichedescriptionAction($id)
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('@Event/Event/Description.html.twig', array('e' => $event));
    }

    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('event_UserEvent' );


    }

    public function AfficheupdateAction($id)
    {   $categorie=$this->getDoctrine()->getRepository(Category::class)->findAll();
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('@Event/Event/update.html.twig', ['e' => $event,'cat'=>$categorie]);
    }


    public function UpdateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        if ($request->isMethod('POST')) {
            $event->setEvent_Name($request->get('eventName'));
            $event->setAddress($request->get('address'));
            $event->setNb_Participant($request->get('nb'));
            $idCategory = $request->get('categorie');
            $category = $em->find(Category::class, $idCategory);
            $price = $request->get('price');
            $event->setCategory($category);
            $event->setDescription($request->get('description'));
            $event->setPriceTicket($price);
            $event->setArchive(false);
            $event->setStart_Date(new \DateTime($request->get('startDate')));
            $event->setEnd_Date(new \DateTime($request->get('endDate')));
            $em->flush();
        }
        return $this->redirectToRoute('event_homeAffiche' );

    }


    public function EventLikeAction(Event $event)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('TechEventBundle:Event_likes');


        $user = $this->getUser();

        $isEventLiked = $repo->findOneBy(['event' => $event, 'user' => $user]);


        if ($isEventLiked != null) {
            $em->remove($isEventLiked);
            $em->flush();
            $event->setNbLike($event->getNbLike()-1);
            $em->flush();

            return new Response("disliked");
        } else {
            $eventLikes = new Event_likes();
            $eventLikes->setUser($user);



            $eventLikes->setEvent($event);
            $em->persist($eventLikes);
            $em->flush();
            $event->setNbLike($event->getNbLike()+1);
            $em->flush();
            return new Response("liked");
        }
    }

    public function searchEventAction(Request $request, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('TechEventBundle:Event');

        $events = $repo->findByName($name);

        foreach ($events as $event) {

            $isEventLiked = $this->getDoctrine()
                ->getRepository(Event_likes::class)
                ->findOneBy(['event' => $event, 'user' => $this->getUser()]);

            if ($isEventLiked == null)
                $event->setIsLiked(false);
            else
                $event->setIsLiked(true);
        }


        return $this->render('@Event/Event/event_item.html.twig', ['events' => $events]);
    }

    public function allEventsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('TechEventBundle:Event');

        $events = $repo->findAll();

        foreach ($events as $event) {

            $isEventLiked = $this->getDoctrine()
                ->getRepository(Event_likes::class)
                ->findOneBy(['event' => $event, 'user' => $this->getUser()]);

            if ($isEventLiked == null)
                $event->setIsLiked(false);
            else
                $event->setIsLiked(true);

        }


        return $this->render('@Event/Event/event_item.html.twig', ['events' => $events]);

    }



    public function AfficheListAction()
    {

        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('@Event/Event/EventUser.html.twig', array('e' => $events));


    }




    public function ArchiveEventsAction()
    {

        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('@Event/Event/AdminArchive.html.twig', array('events' => $events));


    }

    public function ArchiveUpdateAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        if ($request->isMethod('POST')) {
            $event->setArchive(false);
            $em->flush();

        }
        return $this->redirectToRoute('event_homeAffiche');


    }


    public function sortByPriceAction(){

        $events = $this->getDoctrine()->getRepository(Event::class)->sortedPrice();
        return $this->render('@Event/Event/Event.html.twig', array('e' => $events));


    }

    public function sortedByDateAction(){

        $events = $this->getDoctrine()->getRepository(Event::class)->sortedDate();


        foreach ($events as $event) {

            $isEventLiked = $this->getDoctrine()
                ->getRepository(Event_likes::class)
                ->findOneBy(['event' => $event, 'user' => $this->getUser()]);

            if ($isEventLiked == null)
                $event->setIsLiked(false);
            else
                $event->setIsLiked(true);

        }



        return $this->render('@Event/Event/Event.html.twig', array('e' => $events));


    }

    public function sortedByLikeAction(){

        $events = $this->getDoctrine()->getRepository(Event::class)->sortedLike();
        foreach ($events as $event) {

            $isEventLiked = $this->getDoctrine()
                ->getRepository(Event_likes::class)
                ->findOneBy(['event' => $event, 'user' => $this->getUser()]);

            if ($isEventLiked == null)
                $event->setIsLiked(false);
            else
                $event->setIsLiked(true);

        }



        return $this->render('@Event/Event/Event.html.twig', array('e' => $events));


    }



    public function AfficheRequestAction(){

        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('@Event/Event/EventRequest.html.twig', array('e' => $events));


    }


    public function UpdateRequestAction($id){

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        $event->setStatus('ACCEPTED');
        $em->flush();


        return $this->redirectToRoute('event_homeAffiche');

    }


    public function deleteRequestAction($id){

        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('event_EventRequest' );


    }

}
