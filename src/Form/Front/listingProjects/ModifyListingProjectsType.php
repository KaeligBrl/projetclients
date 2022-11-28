<?php

namespace App\Form\Front\listingProjects;

use App\Entity\Filters;
use App\Entity\ListingProjects;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ModifyListingProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domainname', TextType::class, [
                'label' => 'Nom de domaine :',
                'required' => true,
                'label_attr' => ['class' => 'color-yellow'],
            ])
            ->add('name', EntityType::class, array(
                'required' => true,
                'label' => false,
                'choice_label' => fn (Filters $filter) => $filter->getName(),
                'class' => Filters::class,
                'expanded' => true,
                'multiple' => true,
                'label_attr' => ['class' => 'color-white'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
                ))
            ->add('websitetype', ChoiceType::class, [
                'label' => 'Type de site :',
                'choices' => ['Site vitrine' => 'Site vitrine', 'E-commerce' => 'E-commerce'],
                'required' => true,
                'label_attr' => ['class' => 'color-yellow'],
            ])

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
