<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 21/02/2019
 * Time: 15:56
 */

namespace CommentBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReoprtRepository extends EntityRepository
{





    public function countuser($id)
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder("select COUNT rep.user_id from TechEventBundle:Report rep where rep.user_id=:user " )
            ->setParameter('user',$id);
        return $query->getQuery();



    }




}