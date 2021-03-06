<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Client;
use Doctrine\ORM\EntityRepository;

class ClientFieldValueRepository extends EntityRepository
{
    public function findByClient(Client $client)
    {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.field', 'f')
            ->where('v.client = :client')
            ->andWhere('f.enabled = true')
            ->orderBy('f.sort', 'asc')
            ->setParameter('client', $client)
            ->getQuery()
            ->getResult();
    }

    public function findOneByClientAndFieldCode(Client $client, $fieldCode)
    {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.field', 'f')
            ->where('v.client = :client')
            ->andWhere('f.code = :fieldCode')
            ->setParameters(['client' => $client, 'fieldCode' => $fieldCode])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
