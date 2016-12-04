<?php

namespace BamboV\RutrackerCLI;

use BamboV\RutrackerCLI\Exceptions\RutrackerFileIOException;
use BamboV\RutrackerCLI\Interfaces\FileIOInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class FileIO implements FileIOInterface
{
    /**
     * @param string $path
     *
     * @return string
     *
     * @throws RutrackerFileIOException
     */
    public function readFile(string $path): string
    {
        try {
            return fread(fopen($path, 'r'), filesize($path));
        } catch(\Exception $ex) {
            throw new RutrackerFileIOException($ex->getMessage());
        }
    }

    /**
     * @param string $text
     * @param string $path
     * @param string $mode
     *
     * @return string
     */
    public function writeFile(string $text, string $path, string $mode = 'w')
    {
        fwrite(fopen($path, $mode), $text);
        return realpath($path);
    }

}
