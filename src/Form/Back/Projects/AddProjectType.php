<?php

namespace App\Form\Back\Projects;

use App\Entity\Projects;
use App\Entity\Customer;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AddProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'label' => 'Client',
                'required' => true,
                'label_attr' => ['class' => 'label-custom'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
                },
            ])
            ->add('wordpressInstallation', DateType::class, [
                'label' => 'Installation Wordpress',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
                'widget' => 'single_text'
            ])
            ->add('customerbrief', CheckboxType::class, [
                'label' => 'Brief client reçu',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('comingsoon', CheckboxType::class, [
                'label' => 'Page de maintenance créée',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('customercontentreception', CheckboxType::class, [
                'label' => 'Contenu client reçu',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('webdesignprogress', CheckboxType::class, [
                'label' => 'Maquette en cours',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('webdesignsend', CheckboxType::class, [
                'label' => 'Maquette envoyée',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('webdesignvalidated', CheckboxType::class, [
                'label' => 'Maquette validée',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('webintegration', CheckboxType::class, [
                'label' => 'Intégration web faite',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('webtraining', CheckboxType::class, [
                'label' => 'Formation de prise en main effectuée',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            
            ->add('online', DateType::class, [
                'label' => 'Mise en ligne',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
                'widget' => 'single_text'
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
            'data_class' => Projects::class,
        ]);
    }
}
