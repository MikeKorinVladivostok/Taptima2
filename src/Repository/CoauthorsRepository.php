<?php
//
//namespace App\Repository;
//
//use App\Entity\Coauthors;
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Persistence\ManagerRegistry;
//
///**
// * @method Coauthors|null find($id, $lockMode = null, $lockVersion = null)
// * @method Coauthors|null findOneBy(array $criteria, array $orderBy = null)
// * @method Coauthors[]    findAll()
// * @method Coauthors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */
//class CoauthorsRepository extends ServiceEntityRepository
//{
//    public function __construct(ManagerRegistry $registry)
//    {
//        parent::__construct($registry, Coauthors::class);
//    }
//
//    // /**
//    //  * @return Coauthors[] Returns an array of Coauthors objects
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
//    public function findOneBySomeField($value): ?Coauthors
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
