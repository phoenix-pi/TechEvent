<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 25/02/2019
 * Time: 20:19
 */

namespace NewsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class SubscriberRepository extends EntityRepository
{
    public function findSubByEmail($email) {
        $query=$this->getEntityManager()
            ->createQuery("select s from TechEventBundle:Subscriber s where s.email_subscriber = :email")
            ->setParameter('email', $email);
        return $query->getResult();
    }
}