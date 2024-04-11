<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Image;


class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('BirthDate', null, [
                'widget' => 'single_text',
            ])
            ->add('technology')
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ]
            ])
            ->add('email_id', EmailType::class)
            ->add('profile_pic', FileType::class,  array('data_class' => null,'required' => false, 'constraints' => (
                    new Image()
                )))
            ->add('profile_link');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
