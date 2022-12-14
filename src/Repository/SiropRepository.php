<?php

namespace App\Repository;

use App\Entity\Sirop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sirop>
 *
 * @method Sirop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sirop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sirop[]    findAll()
 * @method Sirop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiropRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sirop::class);
    }

    public function allByDisplayOrder()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.displayOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $slug
     * @return Sirop|null
     * @throws NonUniqueResultException
     */
    public function getOneBySlug(string $slug): ?Sirop
    {
        return $this->createQueryBuilder('s')
                    ->where('s.urlSlug = :slug')
                    ->setParameter('slug', $slug)
                    ->getQuery()
                    ->getOneOrNullResult()
        ;
    }

    public function add(Sirop $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sirop $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Sirop[] Returns an array of Sirop objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sirop
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
