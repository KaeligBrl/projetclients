<?php

namespace App\Form\Back\Customer;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifyCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => true,
                'label' => 'Nom du client',
            ))
            ->add('firstname', TextType::class, [
                'required' => false,
                'label' => 'Prénom',
            ])
            ->add('address', TextType::class, [
                'required' => false,
                'label' => 'Adresse',
            ])
            ->add('postalCode', TextType::class, [
                'required' => false,
                'label' => 'Code postal',
            ])
            ->add('tva', TextType::class, [
                'required' => false,
                'label' => 'N° TVA',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn-submit'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
