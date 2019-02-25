<?php
/**
 * Created by PhpStorm.
 * User: Ihèb
 * Date: 20/02/2019
 * Time: 05:04
 */

namespace NewsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findByDomainKeywordAndOrderBy($d, $k, $o)
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
                'SELECT a FROM TechEventBundle:Article a where a.titleArticle LIKE :key'.$sql)
            ->setParameter('key', '%'.$k.'%')
            ->getResult();
    }


    public function getArticleByDomain($domain){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM TechEventBundle:Article a where a.domain=:domain and a.newsletter is null')
            ->setParameter('domain',$domain)
            ->getResult();
    }

}