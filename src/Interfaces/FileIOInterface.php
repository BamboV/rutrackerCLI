<?php

namespace BamboV\RutrackerCLI\Interfaces;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
interface FileIOInterface
{
    /**
     * @param $path
     *
     * @return string
     */
    public function readFile(string $path): string;

    /**
     * @param string $text
     * @param string $path
     * @param string $mode
     */
    public function writeFile(string $text, string $path, string $mode='w');
}
