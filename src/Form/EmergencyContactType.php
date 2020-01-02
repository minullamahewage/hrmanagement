<?php

namespace App\Form;

use App\Entity\EmergencyContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class EmergencyContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('telephone',NumberType::class,[
                'constraints' => [
                
                    new Length([
                        'min' => 9,
                        'max' => 9,
                        'minMessage' => 'Your telephone number should be {{ limit }} characters',
                        'maxMessage' => 'Your telephone number should be  {{ limit }} characters'
                        
                    ])]])
            ->add('emp_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmergencyContact::class,
        ]);
    }
}
