<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit : ',
                'attr' => [
                    'placeholder' => 'Nom du produit'
                ]
            ])
            ->add('length', IntegerType::class, [
                'label' => 'Longueur du produit : ',
                'attr' => [
                    'placeholder' => 'Longueur du produit'
                ]
            ])
            ->add('width', IntegerType::class, [
                'label' => 'Largeur du produit : ',
                'attr' => [
                    'placeholder' => 'Largeur du produit'
                ]
            ])
            ->add('height', IntegerType::class, [
                'label' => 'Hauteur du produit : ',
                'attr' => [
                    'placeholder' => 'Hauteur du produit'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
