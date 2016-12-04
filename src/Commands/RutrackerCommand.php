<?php

namespace BamboV\RutrackerCLI\Commands;


use BamboV\RutrackerCLI\Services\RutrackerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
abstract class RutrackerCommand extends Command
{
    /**
     * @var RutrackerService
     */
    protected $rutrackerService;

    protected function configure()
    {
        parent::configure();
        $this->addOption('new_login');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->rutrackerService = new RutrackerService($input->getOption('new_login'));
    }

}
