<?php

namespace App\Controller;

use App\Entity\Coauthors;
use App\Form\CoauthorForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoauthorController extends AbstractController
{
    /**
     * @Route("/coauthor", name="coauthor")
     */
    public function index(): Response
    {
        return $this->render('coauthor/form.html.twig', [
            'controller_name' => 'CoauthorController',
        ]);
    }

    public function form()
    {
        $form = $this -> createForm(CoauthorForm::class);
        return $this->render('coauthor/form.html.twig', ['form' => $form -> createView()]);
    }

    public function read()
    {
        $coAuthor = array();

        $product = $this->getDoctrine()
            ->getRepository(Coauthors::class)
            ->findAll();

        foreach ($product as $value)
        {
            $coAuthor[] = array(
                'id'     => $value-> getId(),
                'author' => $value-> getAuthorId(),
                'book'   => $value-> getBookId(),
            );
        }

        return $this->render('coauthor/form.html.twig', array(
            'authors' => $coAuthor,
        ));

    }

    public function create(Request $request){

        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        $coAuthor = new Coauthors();

        $coAuthor -> setAuthorId($data['coauthor_form']['author_id']);
        $coAuthor -> setBookId($data['coauthor_form']['book_id']);

        $entityManager->persist($coAuthor);
        $entityManager->flush();

        return $this ->read();

    }

}

