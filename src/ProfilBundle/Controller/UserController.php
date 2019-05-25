<?php

namespace ProfilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Tests\Compiler\J;
use TechEventBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserController extends Controller
{
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('@Profil/User/index.html.twig',array(
            'users'=>$users
        ));

    }



    public  function allAction()
    {

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($users);
        return new JsonResponse($formatted);



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




    public function CurrentuserAction($username){

        $user=$this->getDoctrine()->getRepository(User::class)->findBy(['username' =>$username]);

        $serialiser = new Serializer([new ObjectNormalizer()]);
        $formatted= $serialiser->normalize($user);
        return new JsonResponse($formatted);



    }




    public function loginAction(Request $request,$_username,$_password)
    {
        // This data is most likely to be retrieven from the Request object (from Form)
        // But to make it easy to understand ...

        // Retrieve the security encoder of symfony
        $factory = $this->get('security.encoder_factory');

        /// Start retrieve user
        // Let's retrieve the user by its username:
        // If you are using FOSUserBundle:
        $user_manager = $this->get('fos_user.user_manager');
        $user = $user_manager->findUserByUsername($_username);
        // Or by yourself
        // $user = $this->getDoctrine()->getManager()->getRepository("userBundle:User")
        //   ->findOneBy(array('username' => $_username));
        /// End Retrieve user

        // Check if the user exists !
        if(!$user){
            return new Response(
                'Username doesnt exists',
                Response::HTTP_OK,
                array('Content-type' => 'application/json')
            );
        }

        /// Start verification
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();

        if(!$encoder->isPasswordValid($user->getPassword(), $_password, $salt)) {
            return new Response(
                'Username or Password not valid.',
                Response::HTTP_OK,
                array('Content-type' => 'application/json')
            );
        }
        /// End Verification

        // The password matches ! then proceed to set the user in session

        //Handle getting or creating the user entity likely with a posted form
        // The third parameter "main" can change according to the name of your firewall in security.yml
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->get('session')->set('_security_main', serialize($token));

        // Fire the login event manually
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        /*
         * Now the user is authenticated !!!!
         * Do what you need to do now, like render a view, redirect to route etc.
         */
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);


    }





    public function registermobAction($username,$firstname,$lastname,$password,$phone,$address,$email)
    {

        $user = new User();
        $user->setUsername($username);
        $user->setUsernameCanonical($username);
        $user->setEmail($email);
        $user->setEmailCanonical($email);
        $user->setStatus("Member");
        $user->setPlainPassword($password);
        $user->setAddress($address);
        $user->setFirstName($firstname);
        $user->setLastName($lastname);
        $user->setPhone($phone);
        $user->setEnabled(1);
        $user->setDevisName("user.png");
        $em=$this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }



}
