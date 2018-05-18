<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UniverseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'entity.universe.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'entity.universe.description',
                'required' => false,
            ]);
    }

}
