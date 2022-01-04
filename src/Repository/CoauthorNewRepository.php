<?php

namespace App\Repository;

use App\Entity\CoauthorNew;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoauthorNew|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoauthorNew|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoauthorNew[]    findAll()
 * @method CoauthorNew[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoauthorNewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoauthorNew::class);
    }
    public function get_coauthors() {
        $entityManager = $this->createQueryBuilder('c');
        $query = $entityManager->getQuery();
        return $query->getArrayResult();
    }

    public function get_authors($book_id) {
        $entityManager = $this->createQueryBuilder('c')
        ->where('c.book = :book_id')
        ->setParameter('book_id', $book_id);
        $query = $entityManager->getQuery();
        return $query->getArrayResult();
    }



}
