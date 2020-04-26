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
        $io->title('Attempting to create 2 users...');

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,'testtest'));
        $user->setEmail('test@test.com');

        $this->em->persist($user);

        $user2 = new User();
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'adminadmin'));
        $user2->setEmail('admin@admin.com');

        $this->em->persist($user2);
        $this->em->flush();

        $io->success('Users created successfully!!');

        return 0;
    }

}
