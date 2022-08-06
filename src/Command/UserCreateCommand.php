<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:user:create',
    description: 'Add a short description for your command',
)]
class UserCreateCommand extends Command
{
    private EntityManagerInterface      $em;

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct();
        $this->em                 = $em;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $helper = $this->getHelper('question');

        $user = new User();

        $question = new Question('Email : ');
        $email    = $helper->ask($input, $output, $question);

        $question = new Question('Mot de passe : ');
        $pwd      = $helper->ask($input, $output, $question);

        $question = new ConfirmationQuestion('Administrateur ? (Y/n)', true);

        if ($helper->ask($input, $output, $question)) {
            $user->setRoles(['ROLE_ADMIN']);
        }

        $user->setEmail($email)
             ->setPassword($this->userPasswordHasher->hashPassword($user, $pwd))
        ;

        $this->em->persist($user);
        $this->em->flush();

        $table = new Table($output);
        $table
            ->setRows([
                ['Email', $user->getEmail()],
                ['Password', $pwd],
                ['Roles', implode(', ', $user->getRoles())],
            ])
        ;
        $table->render();

        $io->success('Ok !');

        return Command::SUCCESS;
    }
}
