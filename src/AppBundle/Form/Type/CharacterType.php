<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Ethnic;
use AppBundle\Entity\Liability;
use AppBundle\Entity\Morphology;
use AppBundle\Entity\Particularity;
use AppBundle\Entity\Personality;
use AppBundle\Entity\Universe;
use Doctrine\ORM\EntityRepository;
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
                    'entity.character.male' => '0',
                    'entity.character.female' => '1'
                ],
                'label' => 'entity.character.sex'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'entity.character.age',
            ])
            ->add('size', EntityType::class, [
                'label' => 'entity.character.size',
                'class' => Morphology::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('size')
                        ->where('size.type = 1')
                        ->orderBy('size.value', 'ASC');
                },
            ])
            ->add('weight', EntityType::class, [
                'label' => 'entity.character.weight',
                'class' => Morphology::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('weight')
                        ->where('weight.type = 2')
                        ->orderBy('weight.value', 'ASC');
                },
            ])
            ->add('build', EntityType::class, [
                'label' => 'entity.character.build',
                'class' => Morphology::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('build')
                        ->where('build.type = 3')
                        ->orderBy('build.value', 'ASC');
                },
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
                'class' => Ethnic::class,
                'choice_attr' => function (Ethnic $ethnic) {
                    return [
                        'data-id' => $ethnic->getId(),
                        'data-ratio' => $ethnic->getRatio()
                    ];
                }
            ]);
    }

}