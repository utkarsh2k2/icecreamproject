<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;  
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\IcecreamItem;
use AppBundle\Constants\Flavour;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class IcecreamItemType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        // Flavour type
        $builder->add('flavour', ChoiceType::class, array(
                    'choices'  => Flavour::FLAVOURS,
                    'multiple' => false,
                    'expanded' => false,
                    'attr' => array('class' => 'form-control'),
                ))
                // Number of scoops
                ->add('numofscoops', IntegerType::class, array(
                    'required' => true,
                    'attr' => array('style' => 'width: 75px', 'class' => 'form-control'),
                ));
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => IcecreamItem::class,
            'validation_groups' => array('createorder'),
            'csrf_protection' => true,
        ));
    }
    
    public function getBlockPrefix(){
        return 'IcecreamItemType';
    }
}