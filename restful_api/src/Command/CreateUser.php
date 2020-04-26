<?php

namespace App\Command;

use App\Entity\Position;
use App\Entity\User;
use App\Entity\Vessel;
use App\Entity\VesselStatus;
use App\Entity\VesselType;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUser extends Command
{
    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();

        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            ->setName('create_user')
            ->setDescription('Create new User.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting to create user...');

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,'testtest'));
        $user->setEmail('test@test.com');

        $this->em->persist($user);
        $this->em->flush();

        $io->success('User created successfully!!');

        return 0;
    }

}
