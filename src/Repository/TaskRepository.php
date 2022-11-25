<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }
    // ** Priority 1 **
    // Archived
    public function setTaskForArchived($id)
    {
        $sql = "update App\Entity\Task as t set t.archived = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    // UnArchived
    public function setTaskForUnArchived($id)
    {
        $sql = "update App\Entity\Task as t set t.archived = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setTaskArchivedBtn()
    {
        $sql = "update App\Entity\Task as t set t.archived = 1";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setTaskUnArchivedBtn()
    {
        $sql = "update App\Entity\Task as t set t.archived = 0";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setChangeTaskForP1CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1, t.p2 = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskForP1NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1, t.p2 = 0, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskForP2NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 0, t.p2 = 1, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskForP2CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p2 = 1 , t.p1 = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP1NextWeekToP1CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1 , t.p2 = 0, t.nextweek = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP2NextWeekToP2CurrentWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 0 , t.p2 = 1, t.nextweek = 0 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP1CurrentWeekToP1NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 1 , t.p2 = 0, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setChangeTaskP2CurrentWeekToP2NextWeek($id)
    {
        $sql = "update App\Entity\Task as t set t.p1 = 0 , t.p2 = 2, t.nextweek = 1 where t.id = :id";
        $query = $this->getEntityManager()->createQuery($sql)->setParameters(['id' => $id]);
        return $query->getResult();
    }

    public function setRemoveTask()
    {
        $sql = "delete from App\Entity\Task as t where t.nextweek = 0 or t.done = 1";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }

    public function setChangeTaskToCurrentWeek()
    {
        $sql = "update App\Entity\Task as t set t.nextweek = 0 ";
        $query = $this->getEntityManager()->createQuery($sql);
        return $query->getResult();
    }
}
