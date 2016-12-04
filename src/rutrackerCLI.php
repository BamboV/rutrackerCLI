<?php

namespace BamboV\RutrackerCLI;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
error_reporting(E_ERROR | E_PARSE);

require __DIR__.'/../vendor/autoload.php';

use BamboV\RutrackerCLI\Commands\RutrackerDownloadCommand;
use BamboV\RutrackerCLI\Commands\RutrackerGetForumsCommand;
use BamboV\RutrackerCLI\Commands\RutrackerSearchCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RutrackerGetForumsCommand());
$application->add(new RutrackerSearchCommand());
$application->add(new RutrackerDownloadCommand());

$application->run();




