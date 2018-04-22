<?php

namespace FrontBundle\FormType;

use AppBundle\Entity\Difficulty;
use AppBundle\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('preparation', TextareaType::class)
            ->add('cookingSteps', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('duration', TextType::class)
            ->add('difficulty', EntityType::class, [
                'class' => Difficulty::class,
                'choice_label' => 'name'
            ])
            ->add('ingredients', CollectionType::class, [
                'entry_type' => IngredientFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Recipe::class
            ]
        );
    }

}