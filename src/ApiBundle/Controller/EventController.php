<?php

namespace ApiBundle\Controller;
use EventBundle\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\Category;
use TechEventBundle\Entity\Event;
use TechEventBundle\Entity\Event_likes;
use TechEventBundle\Entity\User;


class EventController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApiBundle:Default:index.html.twig');
    }

    public function AfficheEventAction()
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getIdEvent();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($events);
        return new JsonResponse($formatted);

    }


    public function AfficheCategoriesAction()
    {



        $cat =$this->getDoctrine()->getRepository(Category::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cat);
        return new JsonResponse($formatted);



    }




    public function searchEventAction(Request $request, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('TechEventBundle:Event');

        $events = $repo->findByName($name);


        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getIdEvent();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($events);
        return new JsonResponse($formatted);



    }







    public function findEventAction($id)

    {
        $events = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['organizer_id' => $id]);
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($events) {
            return $events->getIdEvent();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);

        $formatted = $serializer->normalize(array(
            "idEvent"=>$events->getId_Event(),
            "EventName"=>$events->getEventName(),
            "categorie"=>$events->getCategory(),
            "organizer"=>$events->getOrganizer(),
            "description"=>$events->getDescription(),
            "nbparticpant"=>$events-> getNb_Participant(),
            "photo"=>$events->getPhoto(),
            "startdate"=>$events->getStart_Date(),
            "enddate"=>$events->getEnd_Date(),
            "Archive"=>$events->getArchive(),
            "PriceTicket"=>$events->getPriceTicket(),
            "nblike"=>$events->getNbLike(),

        ));





        $formatted=$serializer->normalize($formatted);
        return new JsonResponse($formatted);
    }













    public function AddLikeAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $this->getDoctrine()->getRepository(Event::class)->find($req->get('idevent'));
        $user = $this->getDoctrine()->getRepository(User::class)->find($req->get('iduser'));

            $eventLikes = new Event_likes();
            $eventLikes->setUser($user);



            $eventLikes->setEvent($events);
            $em->persist($eventLikes);
            $em->flush();
            $events->setNbLike($events->getNbLike()+1);
            $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getIdEvent();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($events);
        return new JsonResponse($formatted);




    }






    public function DeleteLikeAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $this->getDoctrine()->getRepository(Event::class)->find($req->get('idevent'));
        $user = $this->getDoctrine()->getRepository(User::class)->find($req->get('iduser'));

        $isEventLiked = $this->getDoctrine()
            ->getRepository(Event_likes::class)
            ->findOneBy(['event' => $events, 'user' => $user]);

        $em->remove($isEventLiked);
        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getIdEvent();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($events);
        return new JsonResponse($formatted);




    }




    public function deleteRequestAction($id){

        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getIdEvent();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted=$serializer->normalize($event);
        return new JsonResponse($formatted);


    }











    public function AddAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Event();
        $event->setEvent_Name($request->get('eventName'));
        $event->setAddress($request->get('address'));
        $event->setNb_Participant($request->get('nb'));
        $idCategory = $request->get('categorie');
        $category = $em->find(Category::class, $idCategory);

        // $file = $request->files->get('photo');
        // $filename = md5(uniqid()).'.'.$file->guessExtension();
        //$file->move($this->getParameter('img_directory') , $filename);
        $event->setPhoto('a45813f00f13dc51c27315bd3e800785.jpeg');


        $price = $request->get('price');

        $event->setCategory($category);
        $event->setDescription($request->get('description'));
        $event->setPriceTicket($price);
        $event->setArchive(false);
        $event->setStart_Date(new \DateTime($request->get('startDate')));
        $event->setEnd_Date(new \DateTime($request->get('endDate')));
        $event->setNbLike(0);




        $id=$request->get('user');
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
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
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }



















    public function AfficheLikeAction()
    {


        $em = $this->getDoctrine()->getManager();
        $like =  $em->getRepository('TechEventBundle:Event_likes')->findAll();

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object;
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);


        $formatted=$serializer->normalize($like);
        return new JsonResponse($formatted);



    }
}
