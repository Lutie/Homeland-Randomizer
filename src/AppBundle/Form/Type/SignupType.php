<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SignupType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'entity.sign.login',
            ])
            ->add('username', TextType::class, [
                'label' => 'entity.sign.username',
            ])
            ->add('email', EmailType::class, [
                'label' => 'entity.sign.email',
            ])
            ->add('rawPassword', RepeatedType::class, [ // ce champs va demander de répéter le mdp
                'type' => PasswordType::class, //je veux répéter le champs de type mot de passe
                'first_options' => ['label' => 'entity.sign.first_raw_password'],
                'second_options' => ['label' => 'entity.sign.second_raw_password'],
            ]);
    }

}
