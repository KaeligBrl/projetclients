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
        $where = " WHERE 1 = 1"; // Commencez avec une clause WHERE valide

        if ($idsLpf) {
            $where .= " AND lpf.filters_activities_id IN (" . $idsLpf . ")";
        }
        if ($idsFa) {
            $where .= " AND lpfw.filters_websites_id IN (" . $idsFa . ")";
        }
        if ($idsFe) {
            $where .= " AND lpfe.filter_enterprise_id IN (" . $idsFe . ")";
        }

        $req = "SELECT DISTINCT lp.id, lp.enterprise, lp.domain_name, 
                    GROUP_CONCAT(fa.name_activities SEPARATOR ', ') AS nameActivity, 
                    GROUP_CONCAT(fw.name_websites SEPARATOR ', ') AS nameWebsite, 
                    GROUP_CONCAT(fe.name_enterprise_type SEPARATOR ', ') AS nameEnterpriseType 
            FROM Listing_Projects lp
            LEFT JOIN listing_projects_filters_activities lpf ON lpf.listing_projects_id = lp.id
            LEFT JOIN filters_activities fa ON fa.id = lpf.filters_activities_id
            LEFT JOIN listing_projects_filters_websites lpfw ON lpfw.listing_projects_id = lp.id
            LEFT JOIN filters_websites fw ON fw.id = lpfw.filters_websites_id
            LEFT JOIN listing_projects_filter_enterprise lpfe ON lpfe.listing_projects_id = lp.id
            LEFT JOIN filter_enterprise fe ON fe.id = lpfe.filter_enterprise_id
            $where
            GROUP BY lp.id";

        $req = str_replace('%1', $where, $req);
        $query = $this->getEntityManager()->getConnection()->prepare($req);

        return $query->executeQuery()->fetchAllAssociative();
    }

}
