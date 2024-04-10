<?php

namespace App\Repository;

use Doctrine\ORM\ORMException;
use App\Entity\FilterEnterprise;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<FilterEnterprise>
 *
 * @method FilterEnterprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilterEnterprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilterEnterprise[]    findAll()
 * @method FilterEnterprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilterEnterpriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilterEnterprise::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FilterEnterprise $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(FilterEnterprise $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
