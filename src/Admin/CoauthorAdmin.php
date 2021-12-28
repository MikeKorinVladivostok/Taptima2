<?php


namespace App\Admin;


use App\Entity\Author;
use App\Entity\Book;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CoauthorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('author_id', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
            'class' => Author::class,
            'choice_label' => function(?Author $authors) {
                return $authors ? $authors->getAuthorName() : '';
            },
        ));
        $form->add('book_id', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'class' => Book::class,
                'choice_label' => function(?Book $books) {
                    return $books ? $books->getBookName() : '';
                },
            ));
        $form->add('main_author', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('author_id');
        $datagrid->add('book_id');
        $datagrid->add('main_author');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('author_id');
        $list->addIdentifier('book_id');
        $list->addIdentifier('main_author');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('author_id');
        $show->add('book_id');
        $show->add('main_author');
    }
}