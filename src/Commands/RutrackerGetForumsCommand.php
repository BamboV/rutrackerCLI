<?php

namespace BamboV\RutrackerCLI\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class RutrackerGetForumsCommand extends RutrackerCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setName('forums');
        $this->addOption('reload');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);
        $output->write($this->rutrackerService->getForums($input->getOption('reload')));
    }


}
