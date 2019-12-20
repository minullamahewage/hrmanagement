<?php

namespace App\Form;

use App\Entity\Dependent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DependentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nic')
            ->add('name')
            ->add('email')
            ->add('relationship')
            ->add('telephone')
            ->add('addrLine1')
            ->add('addrLine2')
            ->add('city')
            ->add('country')
            ->add('postalCode')
            ->add('empid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dependent::class,
        ]);
    }
}
