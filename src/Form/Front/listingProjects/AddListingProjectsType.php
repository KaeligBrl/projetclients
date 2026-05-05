<?php

namespace App\Form\Front\listingProjects;

use App\Entity\Customer;
use App\Entity\FiltersWebsites;
use App\Entity\ListingProjects;
use App\Entity\FiltersActivities;
use Doctrine\ORM\EntityRepository;
use App\Entity\FilterEnterprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AddListingProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', EntityType::class, [
                'label' => 'Client :',
                'required' => true,
                'label_attr' => ['class' => 'color-yellow'],
                'class' => Customer::class,
                'choice_label' => fn (Customer $c) => $c->getEntreprise(),
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Sélectionner un client…',
                'attr' => ['class' => 'tom-select-field'],
                'query_builder' => function (EntityRepository $er) use ($options) {
                    $qb = $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
                    if (!empty($options['excluded_customer_ids'])) {
                        $qb->andWhere('c.id NOT IN (:excluded)')
                           ->setParameter('excluded', $options['excluded_customer_ids']);
                    }
                    return $qb;
                },
            ])
            ->add('name_activities', EntityType::class, [
                'required' => false,
                'label' => false,
                'choice_label' => fn (FiltersActivities $filter) => $filter->getNameActivities(),
                'class' => FiltersActivities::class,
                'expanded' => false,
                'multiple' => true,
                'attr' => ['class' => 'tom-select-field', 'data-create-type' => 'activity'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.nameActivities', 'ASC');
                },
            ])
            ->add('nameEnterpriseType', EntityType::class, [
                'required' => false,
                'label' => false,
                'choice_label' => fn (FilterEnterprise $filter) => $filter->getNameEnterpriseType(),
                'class' => FilterEnterprise::class,
                'expanded' => false,
                'multiple' => true,
                'attr' => ['class' => 'tom-select-field', 'data-create-type' => 'enterprise'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.nameEnterpriseType', 'ASC');
                },
            ])

            ->add('nameWebsites', EntityType::class, [
                'required' => false,
                'label' => false,
                'choice_label' => fn (FiltersWebsites $filter) => $filter->getNameWebsites(),
                'class' => FiltersWebsites::class,
                'expanded' => false,
                'multiple' => true,
                'attr' => ['class' => 'tom-select-field', 'data-create-type' => 'website'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.nameWebsites', 'ASC');
                },
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn-submit'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'             => ListingProjects::class,
            'excluded_customer_ids'  => [],
        ]);
    }
}
