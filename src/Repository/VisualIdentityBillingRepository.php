<?php

namespace App\Repository;

use App\Entity\VisualIdentityBilling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisualIdentityBilling>
 */
class VisualIdentityBillingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisualIdentityBilling::class);
    }
}
