<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 21/02/2019
 * Time: 15:56
 */

namespace CommentBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{


      public function count($id)
      {
          $query = $this->getEntityManager()
              ->createQueryBuilder("select com from TechEventBundle:Comment com where com.id_comment=:event " )
          ->setParameter('event',$id);
          return $query->getQuery();



      }






}