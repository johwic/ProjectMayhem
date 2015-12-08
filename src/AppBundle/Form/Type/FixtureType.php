<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

class FixtureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('stage', EntityType::class, array(
            'class'       => 'AppBundle:Stage',
            'placeholder' => 'Select stage',
            'constraints' => array(
                new Valid()
            ),
        ));
        $builder->add('startweek', TextType::class);
        $builder->add('endweek', TextType::class);
    }
}
