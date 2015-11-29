<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('match', 'hidden');
        $builder->add('player', 'hidden');
        $builder->add('units', 'integer');
        $builder->add('odds', 'number', array(
            'scale' => 2,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bet'
        ));
    }

    public function getName()
    {
        return 'bet_type';
    }
}