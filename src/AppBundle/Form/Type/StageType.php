<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Tournament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

use AppBundle\Utils\WhoscoredProvider;

class StageType extends AbstractType
{
    private $provider;

    public function __construct(WhoscoredProvider $provider)
    {
        $this->provider = $provider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('region', 'entity', array(
            'class' => 'AppBundle:Region',
            'placeholder' => 'Select region',
            'mapped' => false
        ));
        $builder->add('name', 'hidden');


        $addTournamentField = function (FormInterface $form, $regionId = null) {
            $form->add('tournament', 'entity', array(
                'class' => 'AppBundle:Tournament',
                'placeholder' => 'Select tournament',
                'query_builder' => function (EntityRepository $repository) use ($regionId) {
                    $qb = $repository->createQueryBuilder('tournament')
                        ->innerJoin('tournament.region', 'region')
                        ->where('region.id = :region')
                        ->setParameter('region', $regionId);

                    return $qb;
                }
            ));
        };

        $addSeasonField = function (FormInterface $form, $tournamentId = null) {
            $form->add('season', 'entity', array(
                'class' => 'AppBundle:Season',
                'placeholder' => 'Select season',
                'query_builder' => function (EntityRepository $repository) use ($tournamentId) {
                    $qb = $repository->createQueryBuilder('season')
                        ->innerJoin('season.tournament', 'tournament')
                        ->where('tournament.id = :t')
                        ->setParameter('t', $tournamentId);

                    return $qb;
                }
            ));
        };

        $addIdField = function (FormInterface $form, $seasonId = null) {
            $ret = (null === $seasonId) ? array() : $this->provider->getStageIds($seasonId);
            $choices = array();
            foreach ($ret as $r) {
                $choices[$r['wsid']] = $r['name'];
            }

            $form->add('wsId', 'choice', array(
                'placeholder' => 'Select stage',
                'choices'     => $choices,
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
            function (FormEvent $event) use ($addSeasonField) {
                $tour = $event->getData()->getTournament();

                $addSeasonField($event->getForm(), ($tour === null) ? null : $tour->getId());
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($addSeasonField) {
                $data = $event->getData();
                $tournamentId = array_key_exists('tournament', $data) ? $data['tournament'] : null;

                $addSeasonField($event->getForm(), $tournamentId);
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($addIdField) {
                $data = $event->getData()->getSeason();

                $addIdField($event->getForm(), ($data === null) ? null : $data->getId());
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($addIdField) {
                $data = $event->getData();
                $id = array_key_exists('season', $data) ? $data['season'] : null;

                $addIdField($event->getForm(), $id);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stage'
        ));
    }

    public function getName()
    {
        return 'stage_type';
    }
}

