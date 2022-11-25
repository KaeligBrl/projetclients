<?php

namespace App\Repository;

use App\Entity\ListingProjects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListingProjects|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListingProjects|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListingProjects[]    findAll()
 * @method ListingProjects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListingProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListingProjects::class);
    }

public function findListingProjectByParam($ids)
{
    $where = "";
    if ($ids) {
        $where =  "where lpf.filters_id in(" . $ids . ")";

    }

    $req = "select distinct(lp.id), lp.websitetype, lp.domainname, group_concat(filters.name SEPARATOR ', ') as name
            from Listing_Projects lp
            left join listing_projects_filters lpf on lpf.listing_projects_id = lp.id
            left join filters on filters.id = lpf.filters_id
%1
group by (lp.id)
";

$req = str_replace('%1', $where, $req);
$query = $this->getEntityManager()->getConnection()->prepare($req);  

return $query->executeQuery()->fetchAllAssociative();
}

    // /**
    //  * @return ListingProjects[] Returns an array of ListingProjects objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Website
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
