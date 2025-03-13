<?php

namespace App\Repository;

use App\Entity\OpenaiApiLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OpenaiApiLog>
 *
 * @method OpenaiApiLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpenaiApiLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpenaiApiLog[]    findAll()
 * @method OpenaiApiLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpenaiApiLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpenaiApiLog::class);
    }

    public function add(OpenaiApiLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OpenaiApiLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OpenaiApiLog[] Returns an array of OpenaiApiLog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OpenaiApiLog
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
