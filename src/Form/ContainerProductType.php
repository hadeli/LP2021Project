<?php

namespace App\Form;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContainerProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id',
                'label' => 'Liste des conteneurs : '
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'label' => 'Liste des produits : '
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité des produits : ',
                'attr' => [
                    'placeholder' => 'Quantité des produits'
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
            'data_class' => ContainerProduct::class,
        ]);
    }
}
