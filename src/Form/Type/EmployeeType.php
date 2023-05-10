<?php

namespace App\Form\Type;

use App\Entity\Employee;
use Symfony\Component\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotNull;

class EmployeeType extends Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'First name can not be empty'
                    ]),
                ]
            ])
            ->add('lastName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Last name can not be empty'
                    ]),
                ]
            ])
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Email can not be empty'
                    ]),
                    new Email([
                        'message' => 'Email is not valid'
                    ]),
                ]
            ])
            ->add('phoneNumber', \Symfony\Component\Form\Extension\Core\Type\TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }

}