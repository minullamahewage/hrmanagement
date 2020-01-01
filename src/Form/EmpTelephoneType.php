<?php

namespace App\Form;

use App\Entity\EmpTelephone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpTelephoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone',NumberType::class,[
                'constraints' => [
                
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your telephone number should be at least {{ limit }} characters'
                        
            ])]])
            ->add('empId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmpTelephone::class,
        ]);
    }
}
