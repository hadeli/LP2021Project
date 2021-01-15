<?php


namespace App\Form;


use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NAME', TextType::class)
            ->add('LENGTH', BigIntType::class)
            ->add('WIDTH', BigIntType::class)
            ->add('HEIGHT', BigIntType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Product']);
    }
}