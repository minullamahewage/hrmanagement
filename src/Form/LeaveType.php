<?php

namespace App\Form;

use App\Entity\Leave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeaveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->leaveTypeChoices = $options['leaveType_choices'];
        $builder
            ->add('leaveType', ChoiceType::class,[
                'choices' => $this->leaveTypeChoices,
            ])
            ->add('fromDate', DateType::class,[
                'widget' =>'single_text',
                'help' =>'yyyy/mm/dd',
            ])
            ->add('tillDate', DateType::class,[
                'widget' =>'single_text',
                'help' =>'yyyy/mm/dd',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Leave::class,
            'leaveType_choices' => null,
        ]);
    }
}
