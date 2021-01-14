<?php

namespace App\Form;

use App\Entity\Containership;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContainershipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du porte-conteneurs : ',
                'attr' => [
                    'placeholder' => 'Nom du porte-conteneurs'
                ]
            ])
            ->add('captainName', TextType::class, [
                'label' => 'Nom du capitaine : ',
                'attr' => [
                    'placeholder' => 'Nom du capitaine'
                ]
            ])
            ->add('containerLimit', IntegerType::class, [
                'label' => 'Limite de conteneur(s) : ',
                'attr' => [
                    'placeholder' => 'Limite de conteneur(s)'
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
            'data_class' => Containership::class,
        ]);
    }
}
