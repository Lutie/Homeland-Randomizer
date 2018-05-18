<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Character;
use Doctrine\ORM\EntityRepository;

class CharacterRepository extends EntityRepository
{

    use CountTrait;

    /**
     * Search
     *
     * @param null $search
     *
     * @return Character[]
     */
    public function search($search = null)
    {
        $qb = $this->createQueryBuilder('character');

        return $qb
            ->select('character')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('character.firstname', ':firstname'),
                    $qb->expr()->like('character.lastname', ':lastname')
                )
            )
            ->setParameter('firstname', '%' . $search . '%')
            ->setParameter('lastname', '%' . $search . '%')
            ->getQuery()
            ->getResult();
    }

}