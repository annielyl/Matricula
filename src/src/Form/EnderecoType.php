<?php

namespace App\Form;

use App\Entity\Endereco;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnderecoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cep',StringType::class)
            ->add('rua',StringType::class)
            ->add('bairro',StringType::class)
            ->add('cidade',StringType::class)
            ->add('estado',StringType::class)
            ->add('numero',StringType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Endereco::class,
        ]);
    }
}
