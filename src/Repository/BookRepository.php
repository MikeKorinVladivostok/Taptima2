<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Coauthors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    private $coauthorNewRepository;
    private $authorRepository;

    public function __construct(ManagerRegistry $registry,
                                CoauthorNewRepository $coauthorNewRepository,
                                AuthorRepository $authorRepository)
    {
        $this->coauthorNewRepository = $coauthorNewRepository;
        $this->authorRepository = $authorRepository;
        parent::__construct($registry, Book::class);
    }

    public function get_books() {
        $entityManager = $this->createQueryBuilder('b');
        $query = $entityManager->getQuery();
        $books = $query->getArrayResult();

        foreach ($books as &$book) {
            $book['author'] = "";
            $book['coauthors'] = "";
            $coauthors = $this->coauthorNewRepository->get_authors($book['id']);
            foreach ($coauthors as $coauthor) {
                $author = $this->authorRepository->find_author($coauthor['author_id']);
                if ($coauthor['main_author'] == 1) {
                    $book['author'] = $author->getAuthorName();
                } else {
                    $book['coauthors'] .= $author->getAuthorName();
                }

            }
        }

        return $books;
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */

    public function sqlQueryDoctrine() : array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b.book_name, COUNT(c.book_id)
            FROM App\Entity\CoauthorNew c JOIN App\Entity\Book b
            WHERE b.id = c.book_id AND c.main_author IS NULL
            GROUP BY c.book_id
            HAVING COUNT(c.book_id) > 2'
        );

        return $query->getResult();
    }

}
