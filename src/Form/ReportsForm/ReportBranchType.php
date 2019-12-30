<?php

namespace App\Form;

use App\Entity\Branch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportBranchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->branchChoices = $options['branch_choices'];
                
        $builder
            ->add('branchId', ChoiceType::class,[
                'choices' => $this->branchChoices,
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Branch::class,
            'branch_choices' =>null
        ]);
    }
}
