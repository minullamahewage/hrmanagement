<?php

namespace App\Form;

use App\Entity\EmpTelephone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Length;

class EmpTelephoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone',NumberType::class,[
                'constraints' => [
                
                    new Length([
                        'min' => 9,
                        'max' => 9,
                        'minMessage' => 'Your telephone number should be {{ limit }} characters',
                        'maxMessage' => 'Your telephone number should be  {{ limit }} characters'
                        
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
