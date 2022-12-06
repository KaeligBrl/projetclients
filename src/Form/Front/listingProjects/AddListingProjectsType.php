<?php

namespace App\Form\Front\listingProjects;

use App\Entity\FiltersWebsites;
use App\Entity\ListingProjects;
use App\Entity\FiltersActivities;
use App\Entity\FiltersEnterprises;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AddListingProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domainname', TextType::class, [
                'label' => 'Nom de domaine :',
                'required' => true,
                'label_attr' => ['class' => 'color-yellow'],
            ])
            ->add('name_activities', EntityType::class, array(
                'required' => true,
                'label' => false,
                'choice_label' => fn (FiltersActivities $filter) => $filter->getNameActivities(),
                'class' => FiltersActivities::class,
                'expanded' => true,
                'multiple' => true,
                'label_attr' => ['class' => 'color-white']
            ))
            ->add('nameEnterprise', EntityType::class, array(
                'required' => true,
                'label' => false,
                'choice_label' => fn (FiltersEnterprises $filter) => $filter->getNameEnterprises(),
                'class' => FiltersEnterprises::class,
                'expanded' => true,
                'multiple' => true,
                'label_attr' => ['class' => 'color-white'],
            ))
            ->add('nameWebsites', EntityType::class, array(
                'required' => true,
                'label' => false,
                'choice_label' => fn (FiltersWebsites $filter) => $filter->getName(),
                'class' => FiltersWebsites::class,
                'expanded' => true,
                'multiple' => true,
                'label_attr' => ['class' => 'color-white'],
            ))

            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn-submit'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListingProjects::class,
        ]);
    }
}
