<?php

namespace App\Repository;

use App\Entity\WebsiteProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebsiteProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebsiteProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebsiteProject[]    findAll()
 * @method WebsiteProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebsiteProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebsiteProject::class);
    }
    public function setChangeStepsForInProgressProjectsFront($id)
    {
        $sql = "update App\Entity\WebsiteProject as t set t.finished = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

}
