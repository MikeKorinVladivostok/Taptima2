<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Coauthors;
use App\Form\BookForm;
use Doctrine\Persistence\ManagerRegistry;
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

    public function create(ManagerRegistry $doctrine, Request $request)
    {
        $entityManager = $doctrine->getManager();
        $data = $request->request->all();

        $fotoname = rand(1000,9999). time().'_'.$_FILES['book_form']['name']['images'];
        $destiation_dir = basename('/public/image/'. $fotoname);
        move_uploaded_file($_FILES['book_form']['tmp_name']['images'], $destiation_dir );

        $book  = new Book();

        $book-> setBookName($data['book_form']['book_name']);
        $book-> setAuthor($data['book_form']['author']);
        $book-> setTitle($data['book_form']['title']);
        $book-> setImages($destiation_dir);
        $book-> setYear($data['book_form']['year']);

        $entityManager->persist($book);
        $entityManager->flush();

        $coauthor_to_book = new Coauthors();

        $coauthor_to_book -> setBookId($book->getId());
        $coauthor_to_book -> setAuthorId($data['book_form']['author']);
        $coauthor_to_book -> setMainAuthor(true);

        $entityManager->persist($coauthor_to_book);
        $entityManager->flush();

        return $this->redirect('http://taptima2/book/read');

    }
    public function read()
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();

        $book_array = array();

        foreach ($book as $value) {
            $book_array[] = array(
                'id'          => $value -> getId(),
                'book_name'   => $value -> getBookName(),
                'author'      => $value -> getAuthor(),
                'title'       => $value -> getTitle(),
                'images'      => $value -> getImages(),
                'year'        => $value -> getYear()
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

    public function form()
    {
        $form = $this -> createForm(BookForm::class);
        return $this  -> render('book/form.html.twig', ['form' => $form -> createView()]);
    }
}