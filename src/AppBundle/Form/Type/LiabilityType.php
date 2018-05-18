<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class LiabilityType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'entity.liability.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'entity.liability.description',
                'required' => false,
            ])
            ->add('ratio', IntegerType::class, [
                'label' => 'entity.ethnic.ratio',
            ]);
    }

}
