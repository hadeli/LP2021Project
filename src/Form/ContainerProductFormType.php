<?php


namespace App\Form;


use App\Entity\Container;
use App\Entity\Product;
use Doctrine\DBAL\Types\BigIntType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContainerProductFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('QUANTITY', BigIntType::class)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id',
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Container']);
    }
}