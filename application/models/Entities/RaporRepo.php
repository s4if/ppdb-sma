<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RaporRepo
 *
 * @author s4if
 */
class RaporRepo extends Doctrine\ORM\EntityRepository
{
    public function getData()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->addSelect('r')->from('RaporEntity', 'r');
        $qb->orderBy('r.id', 'ASC');
        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }
    
    public function getDataByRegistrant(RegistrantEntity $reg)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->addSelect('r')->from('RaporEntity', 'r');
        $qb->andwhere('r.registrant = :reg');
        $qb->setParameter('reg', $reg);
        $qb->orderBy('r.id', 'ASC');
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }
}
