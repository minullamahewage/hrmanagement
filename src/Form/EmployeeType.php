<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nic')
            ->add('name')
            ->add('email')
            ->add('addrLine1')
            ->add('addrLine2')
            ->add('city')
            ->add('country')
            ->add('postalCode')
            ->add('dob')
            ->add('maritalStatus')
            ->add('branchId')
            ->add('payGrade')
            ->add('supervisorId')
            ->add('deptId')
            ->add('empStatusId')
            ->add('jobTitleId')
            ->add('attribute')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
