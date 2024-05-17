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
        // Convert arrays to comma-separated strings if they are arrays
        $idsLpf = is_array($idsLpf) ? implode(',', $idsLpf) : $idsLpf;
        $idsFa = is_array($idsFa) ? implode(',', $idsFa) : $idsFa;
        $idsFe = is_array($idsFe) ? implode(',', $idsFe) : $idsFe;

        // Start building the base query
        $req = "
            SELECT lp.id, lp.enterprise, lp.domain_name, 
                GROUP_CONCAT(DISTINCT fa.name_activities SEPARATOR ', ') AS nameActivity,
                GROUP_CONCAT(DISTINCT fw.name_websites SEPARATOR ', ') AS nameWebsite,
                GROUP_CONCAT(DISTINCT fe.name_enterprise_type SEPARATOR ', ') AS nameEnterpriseType
            FROM Listing_Projects lp
            LEFT JOIN listing_projects_filters_activities lpf ON lpf.listing_projects_id = lp.id
            LEFT JOIN filters_activities fa ON fa.id = lpf.filters_activities_id
            LEFT JOIN listing_projects_filters_websites lpfw ON lpfw.listing_projects_id = lp.id
            LEFT JOIN filters_websites fw ON fw.id = lpfw.filters_websites_id
            LEFT JOIN listing_projects_filter_enterprise lpfe ON lpfe.listing_projects_id = lp.id
            LEFT JOIN filter_enterprise fe ON fe.id = lpfe.filter_enterprise_id
        ";

        // Append the WHERE clause based on the filters provided
        $conditions = [];
        if ($idsLpf) {
            $conditions[] = "lpf.filters_activities_id IN ($idsLpf)";
        }
        if ($idsFa) {
            $conditions[] = "lpfw.filters_websites_id IN ($idsFa)";
        }
        if ($idsFe) {
            $conditions[] = "lpfe.filter_enterprise_id IN ($idsFe)";
        }

        if (count($conditions) > 0) {
            $req .= " WHERE " . implode(' AND ', $conditions);
        }

        // Append GROUP BY and ORDER BY clauses
        $req .= " GROUP BY lp.id ORDER BY lp.enterprise ASC";

        $query = $this->getEntityManager()->getConnection()->prepare($req);

        return $query->executeQuery()->fetchAllAssociative();
    }
}
