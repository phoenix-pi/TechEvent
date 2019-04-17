<?php

namespace ProfilBundle\Repository;


use Doctrine\ORM\EntityRepository;

class User_StoryRepository extends EntityRepository
{
    public function findS($x) {

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT story_id FROM user_story us
        WHERE us.id_user = :x
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();


    }
}