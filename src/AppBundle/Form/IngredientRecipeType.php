<?php

namespace AppBundle\Form;

use AppBundle\Entity\Ingredient;
use AppBundle\Entity\Unity;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class IngredientRecipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('serving', IntegerType::class, [
                'label' => 'Nombre de personnes *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('unity', EntityType::class, [
                'class' =>Unity::class,
                'label' => 'Unité *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->addOrderBy('u.unity', 'ASC');
                },
                'choice_label' => function ($unity) {
                    return $unity->getUnity();
                }])
            ->add('ingredient', EntityType::class, [
                'class' =>Ingredient::class,
                'label' => 'Ingrédient *',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->addOrderBy('i.type', 'ASC');
                },
                'choice_label' => function ($ingredient) {
                    return $ingredient->getType();
                }]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\IngredientRecipe'
        ));
    }


}
