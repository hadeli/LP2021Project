<?php

namespace App\Form;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\Containership;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContainerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color', TextType::class, [
                'label' => 'Couleur du conteneur : ',
                'attr' => [
                    'placeholder' => 'Couleur du conteneur'
                ]
            ])
            ->add('containerModel', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name',
                'label' => 'Modèle du conteneur : '
            ])
            ->add('containership', EntityType::class, [
                'class' => Containership::class,
                'choice_label' => 'name',
                'label' => 'Porte-conteneur : '
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Container::class,
        ]);
    }
}
