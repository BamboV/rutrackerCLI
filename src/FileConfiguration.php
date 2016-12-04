<?php

namespace BamboV\RutrackerCLI;

use BamboV\RutrackerCLI\Exceptions\RutrackerCLIException;
use BamboV\RutrackerCLI\Interfaces\ConfigurationInterface;
use BamboV\RutrackerCLI\Entities\Settings;
use BamboV\RutrackerCLI\Interfaces\FileIOInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class FileConfiguration implements ConfigurationInterface
{
    /**
     * @var FileIOInterface
     */
    private $fileIO;

    /**
     * FileConfiguration constructor.
     *
     * @param FileIOInterface $fileIO
     */
    public function __construct(FileIOInterface $fileIO)
    {
        $this->fileIO = $fileIO;
    }

    public function getSettings(): Settings
    {
        if(
            ($configuration = $this->fileIO->readFile('settings.json')) ==null
        )
        {
            throw new RutrackerCLIException("You mush fill up settings.json at first (see settings.json.example) \n");
        }
        if(
            ($configuration = json_decode($configuration, true)) ==null
        )
        {
            throw new RutrackerCLIException("File settings.json have wrong format");
        }

        $settings = new Settings();
        $settings->setDefaultPath($configuration['default_download_path']);
        $settings->setLogin($configuration['rutracker_login']);
        $settings->setPassword($configuration['rutracker_password']);
        $settings->setOnTorrentDownloadScriptPath($configuration['on_torrent_download_script_path']);

        return $settings;
    }

}
