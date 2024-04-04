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

public function findListingProjectByParam($idsLpf, $idsFa, $idsFe)
{
    $where = "";
    if ($idsLpf) {
        $where =  "where lpf.filters_activities_id in(" . $idsLpf . ")";
    }
    if ($idsFa) {
        if ($where) {
            $where =  "where lpfw.filters_websites_id in(" . $idsFa . ")";
        } else {
            $where .=  "and lpfw.filters_websites_id in(" . $idsFa . ")";
        }
    }
    if ($idsFe) {
        if ($where) {
            $where =  "where lpfe.filters_enterprises_id in(" . $idsFe . ")";
        } else {
            $where .=  "and lpfe.filters_enterprises_id in(" . $idsFe . ")";
        }
    }


    $req = "select distinct(lp.id), lp.enterprise, lp.domain_name, group_concat(fa.name_activities SEPARATOR ', ') as nameActivity, group_concat(fw.name_websites SEPARATOR ', ') as nameWebsite, group_concat(fe.name_enterprise_type SEPARATOR ', ') as nameEntreprise 
            from Listing_Projects lp
            left join listing_projects_filters_activities lpf on lpf.listing_projects_id = lp.id
            left join filters_activities fa on fa.id = lpf.filters_activities_id
            left join listing_projects_filters_websites lpfw on lpfw.listing_projects_id = lp.id
            left join filters_websites fw on fw.id = lpfw.filters_websites_id
            left join listing_projects_filter_enterprise_type lpfe on lpfe.listing_projects_id = lp.id
            left join filter_enterprise_type fe on fe.id = lpfe.filter_enterprise_type_id
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
