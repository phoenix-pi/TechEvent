<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/21/2019
 * Time: 6:39 PM
 */

namespace ClubBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ClubRepository extends EntityRepository
{
    public function FindClub($name)
    {
        $q=$this->getEntityManager()
            ->createQuery("select c from TechEventBundle:Club c where c.theme= 
            (select t from TechEventBundle:Theme t where t.theme_name=:name ) and c.club_status='Accepted'")
            ->setParameter('name',$name);
        return $q->getResult();
    }

    public function FindOwnerClub($id)
    {
        $q=$this->getEntityManager()
            ->createQuery("select c from TechEventBundle:Club c where c.owner=:id and c.club_status='Accepted'")
            ->setParameter('id',$id);
        return $q->getResult();
    }

    public function FindMembersClub($id)
    {
        $q=$this->getEntityManager()
            ->createQuery("select m from TechEventBundle:ClubUser m where m.club=:id_m ")
        ->setParameter('id_m',$id);
        return $q->getResult();
    }
    public function FindMyClub($id)
    {
        $q=$this->getEntityManager()
            ->createQuery("select m from TechEventBundle:ClubUser m where m.member=:id and m.club_user_status='Accepted'")
            ->setParameter('id',$id);
        return $q->getResult();
    }
    public function showClub()
    {
        $q=$this->getEntityManager()
            ->createQuery("select c from TechEventBundle:Club c where c.club_status='Accepted'");
        return $q->getResult();
    }
    public function findMemberClub()
    {
        $q=$this->getEntityManager()
            ->createQuery("select u from TechEventBundle:User u where u.id=(select m.id_club_user from TechEventBundle:ClubUser m)");
        return $q->getResult();
    }
    public function myfindMemberClub($idclub)
    {
        $q=$this->getEntityManager()
            ->createQuery("select u from TechEventBundle:ClubUser u where u.id_club_user=:id_club ")
            ->setParameter('id_club',$idclub);
        return $q->getResult();
    }
}