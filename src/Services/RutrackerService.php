<?php

namespace BamboV\RutrackerCLI\Services;

use BamboV\RutrackerAPI\Entities\Options\SearchOptions;
use BamboV\RutrackerAPI\Entities\RutrackerForum;
use BamboV\RutrackerAPI\Entities\RutrackerForumGroup;
use BamboV\RutrackerAPI\Parsers\SymfonyForumGroupParser;
use BamboV\RutrackerAPI\Parsers\SymfonyParser;
use BamboV\RutrackerAPI\RutrackerAPI;
use BamboV\RutrackerCLI\Add3s3s\Rutracker3s3sSender;
use BamboV\RutrackerCLI\CookieManagement;
use BamboV\RutrackerCLI\Entities\Settings;
use BamboV\RutrackerCLI\FileConfiguration;
use BamboV\RutrackerCLI\FileIO;
use BamboV\RutrackerCLI\Interfaces\ConfigurationInterface;
use BamboV\RutrackerCLI\Interfaces\FileIOInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class RutrackerService
{
    /**
     * @var RutrackerAPI
     */
    private $rutrackerAPI;
    /**
     * @var FileIOInterface
     */
    private $fileIO;
    /**
     * @var Settings
     */
    private $settings;


    public function __construct(bool $newLogin = false)
    {
        $this->fileIO = new FileIO();
        $this->settings = (new FileConfiguration($this->fileIO))->getSettings();
        $cookies = new CookieManagement($this->fileIO);
        $this->settings = (new FileConfiguration($this->fileIO))->getSettings();

        $this->rutrackerAPI = new RutrackerAPI(
            $this->settings->getLogin(),
            $this->settings->getPassword(),
            new Rutracker3s3sSender(),
            new SymfonyParser(),
            new SymfonyForumGroupParser(),
            $newLogin?[]:$cookies->getCookies()
        );

        $cookies->writeCookie($this->rutrackerAPI->getCookies());
    }

    public function downloadTorrentFile(int $id)
    {
        $file = $this->rutrackerAPI->downloadTorrent($id);
        $path = $this->fileIO->writeFile(
            $file,
            $this->settings->getDefaultPath().$id.'.torrent'
        );
        if($scriptPath = $this->settings->getOnTorrentDownloadScriptPath()) {
            exec($scriptPath.' '.$path);
        }
    }

    public function getForums($reload = false)
    {
        $forums = $this->fileIO->readFile('forums.txt');
        if($reload || !$forums) {
            $forumGroup = $this->rutrackerAPI->getAllForums();
            $text = '';
            foreach ($forumGroup as $item) {
                /** @var RutrackerForumGroup $item */
                $text.=$item->getId() . "\t" . $item->getTitle() . "\n";
                foreach ($item->getSubForums() as $forum) {
                    /** @var RutrackerForum $forum */
                    $text.=('|-' . $forum->getId() . "\t" . $forum->getTitle() . "\n");
                }
            }
            $this->fileIO->writeFile($text, 'forums.txt', 'w');
            return $text;
        } else {
            return $forums;
        }
    }

    /**
     * @param SearchOptions $options
     *
     * @return array|\BamboV\RutrackerAPI\Entities\RutrackerTopic[]
     */
    public function search(SearchOptions $options)
    {
        return $this->rutrackerAPI->search($options);
    }
}
