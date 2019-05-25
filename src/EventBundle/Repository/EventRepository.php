<?php
/**
 * Created by PhpStorm.
 * User: Dorsaf
 * Date: 23/02/2019
 * Time: 14:23
 */

namespace EventBundle\Repository;


use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    public function findByName($name)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.event_name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }

    public function sortedPrice(){

        $query=$this->getEntityManager()->createQuery("select e from TechEventBundle:Event e ORDER BY e.price_ticket ASC");
        return $result= $query->getResult();


    }

    public function sortedDate(){

        $query=$this->getEntityManager()->createQuery("select e from TechEventBundle:Event e ORDER BY e.start_date DESC");
        return $result= $query->getResult();


    }




    public function sortedLike(){

        $query=$this->getEntityManager()->createQuery("select e.nb_like  from TechEventBundle:Event e ORDER BY e.nb_like ASC");
        return $result= $query->getResult();


    }




}