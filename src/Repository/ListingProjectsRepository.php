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

    public function findListingProjectByParam(?array $idsActivity, ?array $idsWebsite, ?array $idsEnterprise): array
    {
        $qb = $this->getEntityManager()->getConnection()->createQueryBuilder();

        $qb->select(
                'lp.id',
                'lp.enterprise',
                'lp.domain_name',
                "GROUP_CONCAT(DISTINCT fa.name_activities ORDER BY fa.name_activities SEPARATOR ', ') AS nameActivity",
                "GROUP_CONCAT(DISTINCT fw.name_websites ORDER BY fw.name_websites SEPARATOR ', ') AS nameWebsite",
                "GROUP_CONCAT(DISTINCT fe.name_enterprise_type ORDER BY fe.name_enterprise_type SEPARATOR ', ') AS nameEnterpriseType"
            )
            ->from('listing_projects', 'lp')
            ->leftJoin('lp', 'listing_projects_filters_activities', 'lpfa', 'lpfa.listing_projects_id = lp.id')
            ->leftJoin('lpfa', 'filters_activities', 'fa', 'fa.id = lpfa.filters_activities_id')
            ->leftJoin('lp', 'listing_projects_filters_websites', 'lpfw', 'lpfw.listing_projects_id = lp.id')
            ->leftJoin('lpfw', 'filters_websites', 'fw', 'fw.id = lpfw.filters_websites_id')
            ->leftJoin('lp', 'listing_projects_filter_enterprise', 'lpfe', 'lpfe.listing_projects_id = lp.id')
            ->leftJoin('lpfe', 'filter_enterprise', 'fe', 'fe.id = lpfe.filter_enterprise_id')
            ->groupBy('lp.id')
            ->orderBy('lp.enterprise', 'ASC');

        if (!empty($idsActivity)) {
            $qb->andWhere('lpfa.filters_activities_id IN (:idsActivity)')
               ->setParameter('idsActivity', $idsActivity, \Doctrine\DBAL\ArrayParameterType::INTEGER);
        }
        if (!empty($idsWebsite)) {
            $qb->andWhere('lpfw.filters_websites_id IN (:idsWebsite)')
               ->setParameter('idsWebsite', $idsWebsite, \Doctrine\DBAL\ArrayParameterType::INTEGER);
        }
        if (!empty($idsEnterprise)) {
            $qb->andWhere('lpfe.filter_enterprise_id IN (:idsEnterprise)')
               ->setParameter('idsEnterprise', $idsEnterprise, \Doctrine\DBAL\ArrayParameterType::INTEGER);
        }

        return $qb->executeQuery()->fetchAllAssociative();
    }
}
