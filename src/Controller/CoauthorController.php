<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\CoauthorNew;
use App\Entity\Coauthors;
use App\Form\CoauthorForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoauthorController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('coauthor/form.html.twig', [
            'controller_name' => 'CoauthorController',
        ]);
    }

    public function form()
    {
        $form = $this -> createForm(CoauthorForm::class);
        return $this  -> render('coauthor/form.html.twig', ['form' => $form -> createView()]);
    }

    public function read()
    {
        $coAuthor = array();

        $product = $this->getDoctrine()
            ->getRepository(CoauthorNew::class)
            ->findAll();

        foreach ($product as $value)
        {
            $coAuthor[] = array(
                'id'     => $value-> getId(),
                'author' => $value-> getAuthorId(),
                'book'   => $value-> getBookId(),
            );
        }

        return $this->render('coauthor/index.html.twig', array(
            'authors' => $coAuthor,
        ));

    }

    public function create(Request $request){

        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $coAuthor = new CoauthorNew();
        $book = new Book();

        $coAuthor -> setAuthorId($data['coauthor_form']['author_id']);
        $coAuthor -> setBookId($data['coauthor_form']['book_id']);

        $book-> addCoauthorNews($coAuthor);

        $entityManager->persist($coAuthor);
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirect('http://taptima2/coauthor/read');

    }

}

