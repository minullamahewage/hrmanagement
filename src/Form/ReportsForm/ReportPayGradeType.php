<?php
namespace App\Form\ReportsForm;

use App\Entity\PayGrade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportPayGradeType extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options)
     {
         $this->payGradeChoices = $options['payGrade_choices'];
                
         $builder
             ->add('payGrade', ChoiceType::class,[
                 'choices' => $this->payGradeChoices,
                 'label' => 'Pay Grade',
             ])
         ;
     }

     public function configureOptions(OptionsResolver $resolver)
     {
         $resolver->setDefaults([
             'data_class' => PayGrade::class,
             'payGrade_choices' =>null,
         ]);
     }
}
