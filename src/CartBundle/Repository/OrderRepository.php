<?php
/**
 * Created by PhpStorm.
 * User: PC ASUS
 * Date: 22/02/2019
 * Time: 00:17
 */

namespace CartBundle\Repository;


use Doctrine\ORM\EntityRepository;


class OrderRepository extends EntityRepository
{

    function sumquantity($idcart)
    {
        $this->createQueryBuilder('t')
        ->select('count(t.quantity)')
        ->where('t.line_cart=:idcart')
        ->setParameter('idcart',$idcart)
        ->getQuery()
        ->getResult();
    }
}