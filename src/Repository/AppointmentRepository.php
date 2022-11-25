<?php

namespace App\Repository;

use App\Entity\Appointment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Appointment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appointment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appointment[]    findAll()
 * @method Appointment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppointmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appointment::class);
    }
    
    // ** Appointment **
    // Archived
    public function setAppointmentForArchived($id)
    {
        $sql = "update App\Entity\Appointment as t set t.archived = t where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    // UnArchived
    public function setAppointmentForUnArchived($id)
    {
        $sql = "update App\Entity\Appointment as t set t.archived = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setAppointmentArchivedBtn()
    {
        $sql = "update App\Entity\Appointment as t set t.archived = 1";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setAppointmentUnArchivedBtn()
    {
        $sql = "update App\Entity\Appointment as t set t.archived = 0";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }
    
    public function setChangeAppointmentCurrentWeekToNextWeek($id)
    {
        $sql = "update App\Entity\Appointment as t set t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeAppointmentNextWeekToCurrentWeek($id)
    {
        $sql = "update App\Entity\Appointment as t set t.nextweek = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setRemoveAppointment()
    {
        $sql = "delete from App\Entity\Appointment as t where t.nextweek = 0";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setChangeAppointmentToCurrentWeek()
    {
        $sql = "update App\Entity\Appointment as t set t.nextweek = 0";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }
}
