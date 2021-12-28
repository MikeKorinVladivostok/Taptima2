<?php


namespace App\Form;



use App\Controller\AuthorController;
use App\Entity\Author;
use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BookForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book_name', TextType::class)
            ->add('author', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'class' => Author::class,
                'choice_label' => function(?Author $authors) {
                    return $authors ? $authors->getAuthorName() : '';
                },
            ))
            ->add('title', TextType::class)
            ->add('images', \Symfony\Component\Form\Extension\Core\Type\FileType::class)
            ->add('year', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}