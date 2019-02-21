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
            (select t from TechEventBundle:Theme t where t.theme_name=:name )")
            ->setParameter('name',$name);
        return $q->getResult();
    }
    public function showClub()
    {
        $q=$this->getEntityManager()
            ->createQuery("select c from TechEventBundle:Club c where c.club_status='Accepted'");
        return $q->getResult();
    }
}