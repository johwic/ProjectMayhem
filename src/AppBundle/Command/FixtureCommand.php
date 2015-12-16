<?php

namespace AppBundle\Command;

use AppBundle\Utils\SubscriptionManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FixtureCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:get-fixtures')
            ->setDescription('Download fixtures')
            ->addArgument(
                'stage',
                InputArgument::OPTIONAL,
                'Who do you want to greet?',
                0
            )
            ->addArgument(
                'start',
                InputArgument::OPTIONAL,
                'Start week'
            )
            ->addArgument(
                'end',
                InputArgument::OPTIONAL,
                'End week'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $stage = $input->getArgument('stage');
        if ($stage !== 0) {

        } else {
            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
            $sm = new SubscriptionManager($this->getContainer()->get('app.whoscored'), $em);

            $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();
            $week = date('o\WW', time());

            foreach ($subscriptions as $subscription) {
                $rows = $sm->getFixtures($subscription->getStage(), $week);

                $io->writeln("Downloaded $rows matches for stage " . $subscription->getStage()->getName());
            }

            $io->success('Done!');
        }
    }
}