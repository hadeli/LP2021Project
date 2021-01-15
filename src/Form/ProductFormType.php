<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NAME', TextType::class)
            ->add('LENGTH', NumberType::class)
            ->add('WIDTH', NumberType::class)
            ->add('HEIGHT', NumberType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Product']);
    }
}