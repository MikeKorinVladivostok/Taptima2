<?php


namespace App\Admin;


use App\Entity\Author;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AuthorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('author_name', TextType::class);
        $form->add('count_book', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('author_name');
        $datagrid->add('count_book');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('author_name');
        $list->addIdentifier('count_book');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('author_name');
        $show->add('count_book');
    }
}