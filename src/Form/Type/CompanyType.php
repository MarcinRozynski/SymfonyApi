<?php

namespace App\Form\Type;

use App\Entity\Company;
use Symfony\Component\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class CompanyType extends Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 100,
                    ])
                ]
            ])
            ->add('nip', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 100,
                    ])
                ]
            ])
            ->add('address', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 200,
                    ])
                ]
            ])
            ->add('city', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 100,
                    ])
                ]
            ])
            ->add('zipCode', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 50,
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }

}