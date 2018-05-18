<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Ethnic;
use AppBundle\Entity\Liability;
use AppBundle\Entity\Morphology;
use AppBundle\Entity\Particularity;
use AppBundle\Entity\Personality;
use AppBundle\Entity\Universe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CharacterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'entity.character.firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'entity.character.lastname',
            ])
            ->add('universe', EntityType::class, [
                'label' => 'entity.character.universe',
                'class' => Universe::class
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'male' => '0',
                    'femelle' => '1'
                ],
                'label' => 'entity.character.sex'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'entity.character.age',
            ])
            ->add('morphology', EntityType::class, [
                'label' => 'entity.character.morphology',
                'class' => Morphology::class
            ])
            ->add('personality', EntityType::class, [
                'label' => 'entity.character.personality',
                'class' => Personality::class
            ])
            ->add('particularities', EntityType::class, [
                'label' => 'entity.character.particularities',
                'class' => Particularity::class,
                'multiple' => true
            ])
            ->add('liabilities', EntityType::class, [
                'label' => 'entity.character.liabilities',
                'class' => Liability::class,
                'multiple' => true
            ])
            ->add('ethnic', EntityType::class, [
                'label' => 'entity.character.ethnic',
                'class' => Ethnic::class
            ]);
    }

}