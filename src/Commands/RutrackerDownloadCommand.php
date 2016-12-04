<?php

namespace BamboV\RutrackerCLI\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class RutrackerDownloadCommand extends RutrackerCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setName('download');
        $this->addArgument('id', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);
        $this->rutrackerService->downloadTorrentFile($input->getArgument('id'));
    }

}
