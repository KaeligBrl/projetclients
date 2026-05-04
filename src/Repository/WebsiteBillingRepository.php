<?php

namespace App\Repository;

use App\Entity\WebsiteBilling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebsiteBilling>
 */
class WebsiteBillingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebsiteBilling::class);
    }
}