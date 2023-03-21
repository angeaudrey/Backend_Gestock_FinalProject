<?php

namespace App\Form;

use App\Entity\Echange;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EchangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datechange')
            ->add('userquidemande')
            ->add('userquirecoit')
            ->add('articledemande')
            ->add('articlerecu')
            ->add('identifiantproposition')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Echange::class,
        ]);
    }
}
