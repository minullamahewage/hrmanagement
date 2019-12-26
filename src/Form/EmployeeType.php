<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('empId')
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
            ->add('deptId')
            ->add('jobTitle')
            ->add('payGrade')
            ->add('empStatus')
            ->add('supervisorId')
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
