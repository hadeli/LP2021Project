<?php


namespace App\Form;


use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContainershipFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NAME', TextType::class)
            ->add('CAPTAIN_NAME', TextType::class)
            ->add('CONTAINER_LIMIT', BigIntType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Product']);
    }
}