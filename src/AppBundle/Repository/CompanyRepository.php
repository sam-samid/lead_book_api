<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{  
    public function getCompanyByName($companyName){
        $qb = $this->createQueryBuilder('c');
        $qb->select('c')
            ->Where("c.deletedAt IS NULL")   
            ->andWhere("c.name LIKE '%".$companyName."%'");  

        return $qb->getQuery()->getResult();
    }

}