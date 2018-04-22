<?php

namespace FrontBundle\FormType;

use AppBundle\Entity\BaseIngredient;
use AppBundle\Entity\Difficulty;
use AppBundle\Entity\Ingredient;
use AppBundle\Entity\Recipe;
use AppBundle\Entity\Unit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('baseIngredient', EntityType::class, [
                'class' => BaseIngredient::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'this-section-title-field'
                ]
            ])
            ->add('quantity', TextType::class, [
                'attr' => [
                    'class' => 'this-section-label-field'
                ]
            ])
            ->add('unit', EntityType::class, [
                'class' => Unit::class,
                'choice_label' => 'name',
            ])
            ->add('note', TextAreaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Ingredient::class,
                'label' => false,
            ]
        );
    }

}