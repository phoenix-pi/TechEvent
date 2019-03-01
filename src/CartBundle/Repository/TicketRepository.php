<?php
/**
 * Created by PhpStorm.
 * User: PC ASUS
 * Date: 22/02/2019
 * Time: 00:17
 */

namespace CartBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TicketRepository extends EntityRepository
{
    function count($id)
    {

        $query = $this->getEntityManager()
            ->createQuery("SELECT  count (e.id_ticket) as nb from  TechEventBundle:Ticket e where e.event_ticket=:n ")
            ->setParameter('n', $id);
        return $query->getResult();
    }


//    function delTicket($idticket)
//    {
//        $this->createQueryBuilder('t')
//            ->update()
//            ->set('t.status', 'false')
//            ->andWhere('t.id_ticket = ?1')
//            ->setParameter(1, $idticket)
//            ->getQuery()
//            ->execute();
//
//    }

}