<?php

namespace BamboV\RutrackerCLI\Entities;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class Settings
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string | null
     */
    private $defaultPath;

    /**
     * @var string | null
     */
    private $onTorrentDownloadScriptPath;

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return null|string
     */
    public function getDefaultPath()
    {
        return $this->defaultPath;
    }

    /**
     * @param null|string $defaultPath
     */
    public function setDefaultPath($defaultPath)
    {
        $this->defaultPath = $defaultPath;
    }

    /**
     * @return null|string
     */
    public function getOnTorrentDownloadScriptPath()
    {
        return $this->onTorrentDownloadScriptPath;
    }

    /**
     * @param null|string $onTorrentDownloadScriptPath
     */
    public function setOnTorrentDownloadScriptPath($onTorrentDownloadScriptPath)
    {
        $this->onTorrentDownloadScriptPath = $onTorrentDownloadScriptPath;
    }



}
