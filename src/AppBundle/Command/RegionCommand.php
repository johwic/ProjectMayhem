<?php

namespace AppBundle\Command;

use AppBundle\Entity\Region;
use AppBundle\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RegionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:load-regions')
            ->setDescription('Load regions from file')
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


        $regions = json_decode(file_get_contents($file));

        foreach ( $regions as $region ) {
            $reg = new Region();
            $reg->setName($region->name);
            $reg->setWsId($region->id);
            $reg->setType($region->type);

            foreach ( $region->tournaments as $tournament ) {
                $tour = new Tournament();
                $tour->setRegion($reg);
                $tour->setWsId($tournament->id);
                $tour->setName($tournament->name);

                $em->persist($tour);
            }

            $em->persist($reg);
        }

        $em->flush();

        $io->success('Added regions and tournaments.');
    }
}