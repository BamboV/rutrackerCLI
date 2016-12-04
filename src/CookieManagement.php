<?php

namespace BamboV\RutrackerCLI;

use BamboV\RutrackerCLI\Exceptions\RutrackerFileIOException;
use BamboV\RutrackerCLI\Interfaces\FileIOInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class CookieManagement
{
    /**
     * @var FileIOInterface
     */
    private $fileIO;

    /**
     * CookieManagement constructor.
     *
     * @param FileIOInterface $fileIO
     */
    public function __construct(FileIOInterface $fileIO)
    {

        $this->fileIO = $fileIO;
    }

    /**
     * @param array $cookies
     */
    public function writeCookie(array $cookies)
    {
        $c = '';
        foreach($cookies as $cookie) {
            $c.=$cookie."\n";
        }

        $this->fileIO->writeFile($c, 'cookies.txt');
    }

    /**
     * @return array
     */
    public function getCookies()
    {
        try {
            return explode("\n", $this->fileIO->readFile('cookies.txt'));
        } catch (RutrackerFileIOException $ex) {
            return [];
        }
    }
}
