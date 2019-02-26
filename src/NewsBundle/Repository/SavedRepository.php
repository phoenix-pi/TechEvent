<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 20/02/2019
 * Time: 05:04
 */

namespace NewsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class SavedRepository extends EntityRepository
{
    public function findSavedByUserId($id) {
        $query=$this->getEntityManager()
            ->createQuery("select a from TechEventBundle:Article a join TechEventBundle:Saved s where a.idArticle=s.article and s.user=:id")
            ->setParameter('id', $id);
        return $query->getResult();
    }


    public function findByDomainKeywordAndOrderBy($d, $k, $o, $id)
    {
        $sql='';
        if ($d != 'any') {
            $sql = $sql . ' AND a.domain=' . $d . ' ';
        }

        if ($o != 'any') {
            $sql = $sql . ' ORDER BY a.'.$o.' DESC ';
        }
        return $this->getEntityManager()
            ->createQuery(
                'select a from TechEventBundle:Article a join TechEventBundle:Saved s where a.idArticle=s.article and s.user=:id and a.titleArticle LIKE :key'.$sql)
            ->setParameter('id', $id)
            ->setParameter('key', '%'.$k.'%')
            ->getResult();
    }

    public function IAddedItBefore($id_article, $id_user) {
        $query=$this->getEntityManager()
            ->createQuery("select s from TechEventBundle:Saved s where s.article=".$id_article." and s.user=".$id_user);
        return $query->getResult();
    }

    public function IAddedItBeforeObj($id_article, $id_user) {
        $query=$this->getEntityManager()
            ->createQuery("select s from TechEventBundle:Saved s where s.article=".$id_article." and s.user=".$id_user);
        return $query->getResult();
    }
}