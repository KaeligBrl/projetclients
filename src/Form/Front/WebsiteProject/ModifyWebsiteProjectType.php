<?php

namespace App\Form\Front\WebsiteProject;

use App\Entity\WebsiteProject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ModifyWebsiteProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wordpressInstallation', DateType::class, [
                'label' => 'Date d\'installation du WordPress',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('domainText', UrlType::class, [
                'label' => 'Nom de domaine',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('online', DateType::class, [
                'label' => 'Mise en ligne',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn-submit w-100 mt-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebsiteProject::class,
        ]);
    }
}
