<?php

namespace App\Form;

use App\Entity\Dependent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Length;



class DependentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nic',TextType::class,[
                'constraints' => [
                
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your nic should be at least {{ limit }} characters',
                        'max' => 12,
                        'minMessage' => 'Your nic should be less than {{ limit }} characters'
                        
            ])]])
            ->add('name')
            ->add('email', EmailType::class)
            ->add('relationship')
            ->add('telephone',NumberType::class,[
                'constraints' => [
                
                    new Length([
                        'min' => 9,
                        'max' => 9,
                        'minMessage' => 'Your telephone number should be {{ limit }} characters',
                        'maxMessage' => 'Your telephone number should be  {{ limit }} characters'
                        
                    ])]])
                        
            
            ->add('addrLine1')
            ->add('addrLine2')
            ->add('city')
            ->add('country')
            ->add('postalCode',NumberType::class)
            ->add('empid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dependent::class,
        ]);
    }
}
