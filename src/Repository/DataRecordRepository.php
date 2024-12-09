<?php

namespace App\Repository;

use App\Entity\DataRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DataRecord>
 *
 * @method DataRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataRecord[]    findAll()
 * @method DataRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataRecord::class);
    }

    public function add(DataRecord $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DataRecord $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
