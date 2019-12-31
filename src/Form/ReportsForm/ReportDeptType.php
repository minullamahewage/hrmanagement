<?php
namespace App\Form\ReportsForm;

use App\Entity\Department;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportDeptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->deptChoices = $options['dept_choices'];
                
        $builder
            ->add('deptId', ChoiceType::class,[
                'choices' => $this->deptChoices,
                'label' => 'Department',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Department::class,
            'dept_choices' =>null,
        ]);
    }
}
