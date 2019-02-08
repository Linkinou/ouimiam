<?php

namespace App\FormType;

use App\Entity\BaseIngredient;
use App\Entity\Difficulty;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\Unit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('amount', NumberType::class, [
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