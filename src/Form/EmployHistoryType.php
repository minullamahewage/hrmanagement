<?php

namespace App\Form;

use App\Entity\EmployHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->empStatusChoices = $options['emp_Status_Choices'];

        $builder
        ->add('fromDate', DateType::class,[
            'widget' =>'single_text',
            'help' =>'yyyy/mm/dd',
        ])
        ->add('toDate', DateType::class,[
            'widget' =>'single_text',
            'help' =>'yyyy/mm/dd',
        ])
        ->add('empStatusId', ChoiceType::class,[
            'choices' => $this->empStatusChoices,
            'label' => 'Employment Status',
        ])
        ->add('emp_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmployHistory::class,
            'emp_Status_Choices' =>null,
        ]);
    }
}
