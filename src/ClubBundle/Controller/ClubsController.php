<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/16/2019
 * Time: 12:25 PM
 */

namespace ClubBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Club;
use TechEventBundle\Entity\ClubUser;
use TechEventBundle\Entity\Theme;
use TechEventBundle\Entity\User;

class ClubsController extends Controller
{
    public function ClubsListAction()
    {
        return $this->render('@Club/clubs/Clubs.html.twig');
    }
    public function ClubPageAction($id)
    {
        $clubs = $this->getDoctrine()->getRepository(Club::class)->myfindMemberClub($id);
        return $this->render('@Club/Clubs/ClubPage.html.twig',array('club'=>$clubs));
    }
    public function afficherClubAction(Request $request)
    {
        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();
        $clubs = $this->getDoctrine()->getRepository(Club::class)->showClub();
        return $this->render('@Club/Clubs/Clubs.html.twig', array('Club'=>$clubs,'theme'=>$themes));
    }
    public function AdminClubAction(Request $request)
    {

        $clubs = $this->getDoctrine()->getRepository(Club::class)->findAll();
        return $this->render('@Club/Clubs/RequestAdmin.html.twig', array('Clubs'=>$clubs));
    }
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();
        $user=$this->getUser();
        if($request->isMethod('post')){
            $club = new Club();
            $club->setClub_Name($request->get('ClubName'));
            $club->setLogo($request->get('Logo'));
            $club->setEmail($request->get('email'));
            $club->setFacebook($request->get('Facebook'));
            $club->setTheme($this->getDoctrine()->getRepository(Theme::class)->find($request->get('Theme')));
            $club->setClub_Description($request->get('ClubDescription'));
            $club->setOwner($user);
            $em->persist($club);
            $em->flush();

        }
        return $this->render('@Club/Clubs/ClubCreate.html.twig',array('th'=>$themes,'user'=>$user));
        }
    public function StatusClubAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(Club::class)->find($id);
        if ($request->isMethod('POST')) {
            $club->setClub_Status($request->get('status'));
            $em->flush();
        }
        return $this->redirectToRoute('AdminClub');
    }
    public function findClubAction(Request $request)
    {
        $Clubs="";
        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();

        $Clubs = $this->getDoctrine()->getRepository(Club::class)->FindClub($request->get('query'));
        return $this->render('@Club/Clubs/Clubs.html.twig',array(
            'Club'=>$Clubs,'theme'=>$themes
        ));
    }
    public function joinAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $club_id=$this->getDoctrine()->getRepository(Club::class)->find($id);
        $member=$this->getUser();
        if($request->isMethod('post')){
            $userC = new ClubUser();
            $userC->setSkills($request->get('skills'));
            $userC->setWhy($request->get('why'));
            $userC->setYou_Are($request->get('youAre'));
            $userC->setMember($member);
            $userC->setClub($club_id);
            $em->persist($userC);
            $em->flush();

        }
        return $this->render('@Club/Clubs/joinUs.html.twig');
    }

    public function StatusMemberClubAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository(ClubUser::class)->find($id);
        if ($request->isMethod('POST')) {
            $member->setClub_User_Status($request->get('member'));
            $em->flush();
        }
        return $this->redirectToRoute('members');
    }
    public function manClubAction()
    {

        $user = $this->getDoctrine()->getRepository(User::class)->findAll();

        $member = $this->getDoctrine()->getRepository(ClubUser::class)->findAll();

        return $this->render('@Club/Clubs/MembershipRequests.html.twig', array('members'=>$member));
    }
}