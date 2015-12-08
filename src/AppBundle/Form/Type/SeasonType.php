<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

use AppBundle\Entity\Region;
use AppBundle\Utils\WhoscoredProvider;

class SeasonType extends AbstractType
{
    private $provider;

    public function __construct(WhoscoredProvider $provider)
    {
        $this->provider = $provider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('region', EntityType::class, array(
            'class'       => 'AppBundle:Region',
            'placeholder' => 'Select region',
            'mapped'      => false
        ));
        $builder->add('year', HiddenType::class);


        $addTournamentField = function (FormInterface $form, $regionId = null) {
            $form->add('tournament', EntityType::class, array(
                'class'       => 'AppBundle:Tournament',
                'placeholder' => 'Select tournament',
                'query_builder' => function (EntityRepository $repository) use ($regionId) {
                    $qb = $repository->createQueryBuilder('tournament')
                        ->innerJoin('tournament.region', 'region')
                        ->where('region.id = :region')
                        ->setParameter('region', $regionId)
                    ;

                    return $qb;
                }
            ));
        };

        $addIdField = function (FormInterface $form, $tournamentId = null) {
            $ret = (null === $tournamentId) ? array() : $this->provider->getSeasonIds($tournamentId);
            $choices = array();
            foreach ($ret as $r) {
                $choices[$r['name']] = $r['wsid'];
            }

            $form->add('wsId', ChoiceType::class, array(
                'placeholder' => 'Select season',
                'choices'     => $choices,
                'choices_as_values' => true
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($addTournamentField) {
                $data = $event->getData()->getTournament();

                $addTournamentField($event->getForm(), ($data === null) ? null : $data->getRegion()->getId());
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($addTournamentField) {
                $data = $event->getData();
                $region_id = array_key_exists('region', $data) ? $data['region'] : null;

                $addTournamentField($event->getForm(), ($data === null) ? null : $region_id);
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($addIdField) {
                $tour = $event->getData()->getTournament();

                $addIdField($event->getForm(), ($tour === null) ? null : $tour->getId());
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($addIdField) {
                $data = $event->getData();
                $regionId = array_key_exists('tournament', $data) ? $data['tournament'] : null;

                $addIdField($event->getForm(), ($data === null) ? null : $regionId);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Season'
        ));
    }
}