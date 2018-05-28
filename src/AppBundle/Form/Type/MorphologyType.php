<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class MorphologyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'entity.morphology.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'entity.morphology.description',
                'required' => false,
            ])
            ->add('ratio', IntegerType::class, [
                'label' => 'entity.morphology.ratio',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'entity.morphology.type',
                'choices' => [
                    'entity.morphology.size' => 0,
                    'entity.morphology.weight' => 1,
                    'entity.morphology.build' => 2
                ],
            ])
            ->add('value', IntegerType::class, [
                'label' => 'entity.morphology.value',
            ]);
    }

}
