<?php

namespace BamboV\RutrackerCLI\Interfaces;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
interface CommandInterface
{
    public function invoke(array $params);
}
