<?php

namespace App\Repository;

use App\Entity\EmailSetting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmailSetting>
 */
class EmailSettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailSetting::class);
    }

    public function findBySection(string $section): array
    {
        return $this->findBy(['section' => $section], ['id' => 'ASC']);
    }
}
