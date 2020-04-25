<?php

namespace App\Command;

use App\Entity\Position;
use App\Entity\Vessel;
use App\Entity\VesselStatus;
use App\Entity\VesselType;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImport extends Command
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Import csv file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Attempting to import the feed...');

        $reader = Reader::createFromPath(dirname(__DIR__) . '/Data/assignment_dataset.csv', 'r');

        $records = $reader->setHeaderOffset(0);

        foreach ($records as $record)
        {
            $vessel = $this->em->getRepository('App:Vessel')->findOneBy(array('_id' => $record['id']));

            if(empty($vessel)) {
                $vessel = (new Vessel())
                    ->set_Id($record['id'])
                    ->setCallsign($record['callsign'])
                    ->setLength($record['length'])
                    ->setWidth($record['width'])
                    ->setMmsi($record['mmsi'])
                    ->setDraught($record['draught'])
                    ->setHeading($record['heading'])
                    ->setCourse($record['course'])
                    ->setSpeed($record['speed']);
            }

            $position = (new Position())
                ->setLat($record['lat'])
                ->setLon($record['lon']);

            $vessel->addPosition($position);

            $this->em->persist($vessel);
            $this->em->persist($position);

            $status = $this->em->getRepository('App:VesselStatus')->findOneBy(array('name' => $record['status']));
            if(empty($status)){
                $status = (new VesselStatus())
                    ->setName($record['status']);
            }

            $this->em->persist($status);

            $type = $this->em->getRepository('App:VesselType')->findOneBy(array('name' => $record['type']));
            if(empty($type)) {
                $type = (new VesselType())
                    ->setName($record['type']);
            }

            $this->em->persist($type);

            //$position = $this->em->getRepository('App:Position')->findOneBy(array('lat' => $record['lat'], 'lon' => $record['lon']));
            //if(empty($position)) {
                //$position = (new Position())
              //      ->setLat($record['lat'])
              //      ->setLon($record['lon']);
            //}


            $vessel->setType($type);
            $vessel->setStatus($status);
            //$vessel->setPosition($position);

            $this->em->flush();
        }


        //$this->em->flush();

        $io->success('Csv file imported successfully!!');

        return 0;
    }

}
