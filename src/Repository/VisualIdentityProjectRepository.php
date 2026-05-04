<?php

namespace App\Repository;

use App\Entity\VisualIdentityProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisualIdentityProject>
 */
class VisualIdentityProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisualIdentityProject::class);
    }
}
