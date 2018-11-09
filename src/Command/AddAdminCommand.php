<?php

namespace App\Command;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddAdminCommand extends Command
{
    private $em;

    public function __construct(EntityManagerInterface $em, ?string $name = null)
    {
        $this->em = $em;
        parent::__construct($name);
    }

    protected static $defaultName = 'addAdmin';

    protected function configure()
    {
        $this
            ->setName('add-admin')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $admin = new Admin();
        $admin
            ->setUsername('admin')
            ->setPassword(password_hash('123', PASSWORD_BCRYPT));

        try {
            $this->em->persist($admin);
            $this->em->flush();
        } catch (\Exception $exception){
            $io->error($exception->getMessage());
            die();
        }

        $io->success('You have a new admin.');
    }
}
