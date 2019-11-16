<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Order;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\Type\IcecreamItemType;
use AppBundle\Constants\Topping;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        // Customername 
        $builder->add('customername', TextType::class, array(
            'required' => true,
            'label' => 'Customer Name',
            'attr' => [
                'class' => 'form-control',
            ],
        ));
        
        // IcecreamItems
        $builder->add('icecreamitems', CollectionType::class, array(
            'entry_type' => IcecreamItemType::class,
            'entry_options' => [
                'attr' => [
                    'class' => 'item', // we want to use 'tr.item' as collection elements' selector
                ],
            ],
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'required' => false,
            'by_reference' => false,
            'delete_empty' => true,
            'attr' => [
                'class' => 'table discount-collection',
            ],
            'label' => false,
        ));

        // ToppingItems 
        $builder->add('toppingitems', ChoiceType::class, array(
            'choices' => Topping::TOPPINGS,
            'label' => false,
            'multiple' => true,
            'expanded' => false,
            'attr' => [
                'class' => 'form-control topping-items',
            ],
        ));

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Order::class,
            'validation_groups' => array('createorder'),
            'csrf_protection' => true,
        ));
    }

}