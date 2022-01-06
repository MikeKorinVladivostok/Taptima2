<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\CoauthorNew;
use App\Entity\Coauthors;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\EventListener\EventListener;
use App\Form\BookForm;
use Doctrine\Persistence\ManagerRegistry;
use mysqli;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('book/form.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    public function create(ManagerRegistry $doctrine, EventDispatcherInterface $dispatcher, Request $request)
    {
        $entityManager = $doctrine->getManager();
        $data = $request->request->all();

        $fotoname = rand(1000,9999). time().'_'.$_FILES['book_form']['name']['images'];
        $destiation_dir = basename('/public/image/'. $fotoname);
        move_uploaded_file($_FILES['book_form']['tmp_name']['images'], $destiation_dir );

        $book  = new Book();

        $book-> setBookName($data['book_form']['book_name']);
        $book-> setTitle($data['book_form']['title']);
        $book-> setImages($destiation_dir);
        $book-> setYear($data['book_form']['year']);

        $entityManager->persist($book);
        $entityManager->flush();

        $coauthor_to_book = new CoauthorNew();

        $coauthor_to_book -> setBookId($book->getId());
        $coauthor_to_book -> setAuthorId($data['book_form']['author']);
        $coauthor_to_book -> setMainAuthor(true);

        $coauthor_to_book -> setBook($book);

        $entityManager->persist($coauthor_to_book);
        $entityManager->persist($book);

        $entityManager->flush();


        return $this->redirect('http://taptima2/book/read');

    }
    public function read()
    {

        $entityManager = $this->getDoctrine()->getManager();
        $book = $entityManager->getRepository(Book::class)->get_books();

        $book_array = array();

        foreach ($book as $value) {
            if($value['book_name'] == null){
                continue;
            }
            $book_array[] = array(
                'id'          => $value['id'],
                'book_name'   => $value['book_name'],
                'author'      => $value['author'],
                'title'       => $value['title'],
                'images'      => $value['images'],
                'year'        => $value['year'],
            );
        }
        return $this->render('book/index.html.twig', array(
            'books' => $book_array,
        ));
    }

    public function update(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();
        $book = $entityManager->getRepository(Book::class)->find($data['book_form']['id']);

        $book-> setBookName($data['book_form']['author_name']);
        $book-> setAuthor($data['book_form']['author_name']);
        $book-> setTitle($data['book_form']['author_name']);
        $book-> setImages($data['book_form']['author_name']);
        $book-> setYear($data['book_form']['author_name']);

        $entityManager->flush();

        return new JsonResponse(['status' => 'ok','authors' => $data['author_form']['author_name']]);
    }

    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $book = $entityManager->getRepository(Book::class)->find($data['book_form']['id']);

        $entityManager->remove($book);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok']);
    }

    public function SQLDoctrine()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $book = $entityManager->getRepository(Book::class)->sqlQueryDoctrine();

        echo '<pre>'.print_r($book,true).'</pre>';
    }

    public function NativeSQl()
    {
        $mysqli = new mysqli("localhost", "root", "", "taptima2");
        $result = $mysqli->query("SELECT b.book_name,COUNT(c.book_id) AS count FROM CoauthorNew c JOIN Book b WHERE b.id = c.book_id AND c.main_author IS NULL GROUP BY c.book_id HAVING COUNT(c.book_id) > 2");

        foreach ($result as $value){
            echo '<pre>'.print_r($value,true).'</pre>';
        }
    }

    public function bookGenerator()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $destiation_dir = basename('/public/image/default.jpg');

        $author = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findAll();

        $author_array = array();

        foreach ($author as $value) {
            $author_array[] = array(
                'id'          => $value -> getId(),
                'author_name' => $value -> getAuthorName(),
                'count_book'  => $value -> getCountBook(),
            );
        }

        $book_name = array("Властелин колец","Гордость и предубеждение","Тёмные начала","1984","Ветер в ивах","Большие надежды");
        $book_title = array("Lorem ipsum dolor sit amet, consectetur adipiscing elit ");
        $book_year = array("1849", "1714","1999","2016","2010","2015","1998");

        $book  = new Book();

        $book-> setBookName($book_name[rand(0,count($book_name)-1)]);
        $book-> setTitle($book_title[rand(0,count($book_title)-1)]);
        $book-> setImages($destiation_dir);
        $book-> setYear($book_year[rand(0,count($book_year)-1)]);

        $entityManager->persist($book);
        $entityManager->flush();

        $coauthor_to_book = new CoauthorNew();

        $coauthor_to_book -> setBookId($book->getId());
        $coauthor_to_book -> setAuthorId($author_array[rand(0,count($author_array)-1)]['id']);
        $coauthor_to_book -> setMainAuthor(true);

        $coauthor_to_book -> setBook($book);

        $entityManager->persist($coauthor_to_book);
        $entityManager->persist($book);

        $entityManager->flush();

        return $this->redirect('http://taptima2/book/read');
    }


    public function form()
    {
        $form = $this -> createForm(BookForm::class);
        return $this  -> render('book/form.html.twig', ['form' => $form -> createView()]);
    }
}
