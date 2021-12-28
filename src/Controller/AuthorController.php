<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Coauthors;
use App\Form\AuthorForm;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     */
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

        return $this->read();

    }

    public function read()
    {
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
        return $this->render('author/form.html.twig', array(
            'authors' => $author_array,
        ));
    }

    public function update(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();
        $author = $entityManager->getRepository(Author::class)->find($data['author_form']['id']);

        $author->setAutors($data['author_form']['author_name']);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok','authors' => $data['author_form']['author_name']]);
    }

    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $author = $entityManager->getRepository(Author::class)->find($data['author_form']['id']);

        $entityManager->remove($author);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok']);
    }

    public function form()
    {
        $form = $this -> createForm(AuthorForm::class);
        return $this  -> render('author/form.html.twig', ['form' => $form -> createView()]);
    }

}
