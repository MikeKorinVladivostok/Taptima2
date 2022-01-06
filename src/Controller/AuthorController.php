<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\CoauthorNew;
use App\Form\AuthorForm;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class AuthorController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('author/form.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    public function create(ManagerRegistry $doctrine, Request $request)
    {
        $entityManager = $doctrine->getManager();
        $data = $request->request->all();

        $author  = new Author();

        $author-> setAuthorName($data['author_form']['author_name']);
        $entityManager->persist($author);
        $entityManager->flush();

        return $this->redirect('http://taptima2/author/read');

    }

    public function read()
    {
        $this->countBooks();

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
        return $this->render('author/index.html.twig', array(
            'authors' => $author_array,
        ));
    }

    public function update(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $author = $entityManager->getRepository(Author::class)->find($data['id']);

        $author->setAuthorName($data['autors']);
        $entityManager->flush();
        $books = $this->countBooks();

        return new JsonResponse(['status' => 'ok','authors' => $data['autors'], 'books' => $books]);
    }

    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $author = $entityManager->getRepository(Author::class)->find($data['id']);

        $entityManager->remove($author);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok']);
    }
    public function countBooks()
    {
        $authors = $this->getDoctrine()
            ->getRepository(CoauthorNew::class)
            ->findAll();

        $authors_id = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findAll();

        foreach ($authors_id as $id){
            $i = 0;
            $count = 0;
            foreach ($authors as $author){
                if($id->getId() == $author-> getAuthorId()) {
                    $i ++;
                }
                $count = $i;
            }

            $entityManager = $this->getDoctrine()->getManager();
            $author = $entityManager->getRepository(Author::class)->find($id->getId());
            $author->setCountBook($count);

            $entityManager->flush();
        }
        return $this->redirect('http://taptima2/author/read');
    }

    public function form()
    {
        $form = $this -> createForm(AuthorForm::class);
        return $this  -> render('author/form.html.twig', ['form' => $form -> createView()]);
    }

}
