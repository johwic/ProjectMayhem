<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('knownName', 'text', array('attr' => array('class' => 'u-full-width')));
            //->add('save', 'submit', array('label' => 'Create Task', 'attr' => array('class' => 'button-primary')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Player',
            'attr' => array('class' => 'search')
        ));
    }

    public function getName()
    {
        return 'searchPlayer';
    }
}