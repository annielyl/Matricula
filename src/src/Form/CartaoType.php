<?php

namespace App\Form;

use App\Entity\Cartao;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero',StringType::class)
            ->add('cvv',StringType::class)
            ->add('dataValidade',DateType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cartao::class,
        ]);
    }
}
