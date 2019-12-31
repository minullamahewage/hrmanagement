<?php
namespace App\Form\ReportsForm;

use App\Entity\JobTitle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportJobTitleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->jobTitleChoices = $options['jobTitle_choices'];
                
        $builder
            ->add('jobTitleId', ChoiceType::class,[
                'choices' => $this->jobTitleChoices,
                'label' => 'Job Title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobTitle::class,
            'jobTitle_choices' =>null,
        ]);
    }
}
