<?php

namespace App\Command;

use Doctrine\DBAL\Connection;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Process\Process;

#[AsCommand(name: 'app:backup')]
class BackupCommand extends Command
{
    protected static $defaultName = 'app:backup';

    private ManagerRegistry $managerRegistry;

    private string $projectDirectory;

    private SymfonyStyle $io;

    public function __construct(ManagerRegistry $managerRegistry, string $projectDirectory)
    {
        parent::__construct();
        $this->managerRegistry = $managerRegistry;
        $this->projectDirectory = $projectDirectory;
    }

    protected function configure(): void
    {
        $this->setDescription("Save the database");
    }

    protected function initialize(InputInterface $input, OutputInterface $output) : void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fileSystem = new Filesystem();

        $backupDirectory = "{$this->projectDirectory}/var/backup";

        if ($fileSystem->exists($backupDirectory) === true) {
            $fileSystem->remove($backupDirectory);
        } 
        
        try {
            $fileSystem->mkdir($backupDirectory, 0700);
        } catch (IOException $error){
            throw new IOException($error);
        }

        /** @var Connection $databaseConnection */
        $databaseConnection = $this->managerRegistry->getConnection();

        [
            'host' => $databaseHost,
            'port' => $databasePort,
            'user' => $databaseUser,
            'password' => $databasePassword,
            'dbname' => $databasedName,
        ] = $databaseConnection->getParams();

        $filePathTarget = "--result-file={$backupDirectory}/backup.sql";

        $this->io->success('Sauvegarde preparée.');

        return Command::SUCCESS;
    }
}
