<?php

namespace App\Form;


use App\Entity\ContainerModel;
use App\Entity\Containership;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContainerFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('COLOR', TextType::class)
            ->add('containerModel', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name',
            ])
            ->add('containership', EntityType::class, [
                'class' => Containership::class,
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Container']);
    }
}