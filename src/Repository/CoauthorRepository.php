<?php
//
//namespace App\Repository;
//
//use App\Entity\Coauthor;
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Persistence\ManagerRegistry;
//
///**
// * @method Coauthor|null find($id, $lockMode = null, $lockVersion = null)
// * @method Coauthor|null findOneBy(array $criteria, array $orderBy = null)
// * @method Coauthor[]    findAll()
// * @method Coauthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */
//class CoauthorRepository extends ServiceEntityRepository
//{
//    public function __construct(ManagerRegistry $registry)
//    {
//        parent::__construct($registry, Coauthor::class);
//    }
//
//    // /**
//    //  * @return Coauthor[] Returns an array of Coauthor objects
//    //  */
//    /*
//    public function findByExampleField($value)
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
//    */
//
//    /*
//    public function findOneBySomeField($value): ?Coauthor
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
//    */
//}
