<?php

namespace AppBundle\Repository;

trait CountTrait
{

    public function count($targetEntity)
    {
        $qb = $this->createQueryBuilder('' . $targetEntity . '');
        return (int)$qb
            ->select($qb->expr()->countDistinct('' . $targetEntity . '.id'))
            ->getQuery()
            ->getSingleScalarResult();
    }

}