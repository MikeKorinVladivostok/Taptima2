<?php


namespace App\Form;


use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Coauthors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoauthorForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author_id', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'class' => Author::class,
                'choice_label' => function(?Author $authors) {
                    return $authors ? $authors->getAuthorName() : '';
                },
            ))
            ->add('book_id', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'class' => Book::class,
                'choice_label' => function(?Book $books) {
                    return $books ? $books->getBookName() : '';
                },
            ))
            ->add('save', SubmitType::class)

        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coauthors::class,
        ]);
    }
}