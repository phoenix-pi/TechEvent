<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 20/02/2019
 * Time: 05:04
 */

namespace NewsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class DomainRepository extends EntityRepository
{
    public function findDomainByName($name) {
        $query=$this->getEntityManager()
            ->createQuery("select d from TechEventBundle:Domain d where d.name_domain=:name")
            ->setParameter('name', $name);
        return $query->getResult();
    }
}