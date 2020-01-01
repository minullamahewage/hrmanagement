<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->branchChoices = $options['branch_choices'];
        $this->deptChoices = $options['dept_choices'];
        $this->jobTitleChoices = $options['jobTitle_choices'];
        $this->payGradeChoices = $options['payGrade_choices'];
        $this->empStatusChoices = $options['empStatus_choices'];
                
        $builder
            ->add('empId')
            ->add('nic', TextType::class,[
                'constraints' => [
                
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your nic should be at least {{ limit }} characters'
                        
            ])]])
            ->add('name')
            ->add('email', EmailType::class)
            ->add('addrLine1')
            ->add('addrLine2')
            ->add('city')
            ->add('country')
            ->add('postalCode')
            ->add('dob', DateType::class,[
                'widget' =>'single_text',
                'help' =>'yyyy/mm/dd',
            ])
            ->add('maritalStatus', ChoiceType::class,[
                'choices' => [
                    'Married' => 'Married',
                    'Unmarried' => 'Unmarried'
                ],
                'expanded' =>true,
                'multiple' =>false,

            ])
            ->add('branchId', ChoiceType::class,[
                'choices' => $this->branchChoices,
            ])
            ->add('deptId', ChoiceType::class,[
                'choices' =>$this->deptChoices,
            ])
            ->add('jobTitle', ChoiceType::class,[
                'choices' =>$this->jobTitleChoices,
            ])
            ->add('payGrade', ChoiceType::class,[
                'choices' =>$this->payGradeChoices,
            ])
            ->add('empStatus', ChoiceType::class,[
                'choices' =>$this->empStatusChoices,
            ])
            ->add('supervisorId')
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
            'branch_choices' =>null,
            'dept_choices' =>null,
            'jobTitle_choices' => null,
            'payGrade_choices' => null,
            'empStatus_choices' => null,
        ]);
    }
}
