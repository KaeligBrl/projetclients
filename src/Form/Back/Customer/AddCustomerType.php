<?php

namespace App\Form\Back\Customer;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', TextType::class, array(
                'required' => true,
                'label' => 'Entreprise',
            ))
            ->add('firstname', TextType::class, [
                'required' => false,
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'required' => false,
                'label' => 'Nom',
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
