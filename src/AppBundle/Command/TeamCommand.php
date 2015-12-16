<?php

namespace AppBundle\Command;

use AppBundle\Entity\Team;
use AppBundle\Utils\SubscriptionManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TeamCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:load-teams')
            ->setDescription('Load teams from file')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'json-formatted file.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $file = $input->getArgument('file');

        $teams = json_decode(file_get_contents($file));

        foreach ( $teams as $team ) {
            $t = new Team();
            $t->setName($team->name);
            $t->setWsId($team->id);

            $em->persist($t);
        }

        $em->flush();

        $io->success('Added ' . count($teams) . ' teams.');
    }
}