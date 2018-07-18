<?php

namespace AppBundle\Form;

use AppBundle\Entity\Cost;
use AppBundle\Entity\DifficultyLevel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RecipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la recette',
                'attr' => ['maxlength' => 45],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide'])
            ])
            ->add('preparationTime', IntegerType::class, [
                'label' => 'Temps de préparation (min)',
                'required' => false,
            ])
            ->add('cookTime', IntegerType::class, [
                'label' => 'Temps de cuisson (min)',
                'required' => false,
            ])
            ->add('serving', IntegerType::class, [
                'label' => 'Nombre de personnes *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('difficultyLevel', EntityType::class, [
                'class' =>DifficultyLevel::class,
                'label' => 'Niveau de difficulté *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->addOrderBy('d.level', 'ASC');
                },
                'choice_label' => function ($difficultyLevel) {
                    return $difficultyLevel->getLevel();
                }
            ])
            ->add('cost', EntityType::class, [
                'class' =>Cost::class,
                'label' => 'Coût *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->addOrderBy('c.cost', 'ASC');
                },
                'choice_label' => function ($cost) {
                    return $cost->getCost();
                }
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Détail de la recette *',
                'attr' => [
                    'rows' => 5,
                ],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('bestSeller',  ChoiceType::class, [
                'choices'  => [
                    'Non' => 0,
                    'Oui' => 1,
                    ],
                'data' => 0,
                'label' => 'Meilleur recette'
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recipe'
        ));
    }

}
