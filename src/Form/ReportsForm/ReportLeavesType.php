<?php
namespace App\Form\ReportsForm;

use App\Entity\Leave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportLeavesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->deptChoices = $options['dept_choices'];
                
        $builder
            ->add('deptId', ChoiceType::class,[
                'choices' => $this->deptChoices,
                'label' => 'Department',
                'mapped' => false
                
            ])
            ->add('beginDate', DateType::class,[
                'widget' =>'choice',
                'mapped' => false,
                'years' => range(date('Y')-10, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
            ])
            ->add('endDate', DateType::class,[
                'widget' =>'choice',
                'mapped' => false,
                'years' => range(date('Y')-10, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Leave::class,
            'dept_choices' => null
        ]);
    }
}

