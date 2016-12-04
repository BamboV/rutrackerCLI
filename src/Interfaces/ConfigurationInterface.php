<?php

namespace BamboV\RutrackerCLI\Interfaces;

use BamboV\RutrackerCLI\Entities\Settings;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
interface ConfigurationInterface
{
    /**
     * @return Settings
     */
    public function getSettings(): Settings;
}
