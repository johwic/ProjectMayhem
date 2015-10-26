<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

class FixtureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('stage', 'entity', array(
            'class'       => 'AppBundle:Stage',
            'placeholder' => 'Select stage',
            'constraints' => array(
                new Valid()
            ),
        ));
        $builder->add('startweek', 'text');
        $builder->add('endweek', 'text');
    }

    public function getName()
    {
        return 'fixture_type';
    }
}
