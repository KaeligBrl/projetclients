<?php

namespace App\Form\Back\Projects;

use App\Entity\Projects;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ModifyProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wordpressInstallation', DateType::class, [
                'label' => 'Date d\'installation du WordPress',
                'required' => false,
                'label_attr' => ['class' => 'label-custom'],
                'widget' => 'single_text'
            ])
            ->add('domain', TextType::class, [
                'label' => 'Nom de domaine',
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ]);
    }
}
