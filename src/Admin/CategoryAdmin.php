<?php


namespace App\Admin;


use App\Entity\Author;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('book_name', TextType::class);
        $form->add('author', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
        'class' => Author::class,
        'choice_label' => function(?Author $authors) {
            return $authors ? $authors->getAuthorName() : '';
        },));
        $form->add('title', TextType::class);
        $form->add('images', \Symfony\Component\Form\Extension\Core\Type\FileType::class);
        $form->add('year', TextType::class);

    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('book_name');
        $datagrid->add('author');
        $datagrid->add('title');
        $datagrid->add('images');
        $datagrid->add('year');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('book_name');
        $list->addIdentifier('author');
        $list->addIdentifier('title');
        $list->addIdentifier('images');
        $list->addIdentifier('year');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('book_name');
        $show->add('author');
        $show->add('title');
        $show->add('images');
        $show->add('year');
    }
}