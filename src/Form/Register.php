<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 1.1.2018
 * Time: 23:35
 */

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class Register extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'Emaily se musí shodovat.',
                'first_options' => ['label' => 'Email'],
                'second_options' => ['label' => 'Email znovu']
            ])
            ->add('user_name', TextType::class, ['label' => 'Uživatelské jméno'])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Hesla se musí shodovat.',
                'first_options'  => ['label' => 'Heslo'],
                'second_options' => ['label' => 'Heslo znovu']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}