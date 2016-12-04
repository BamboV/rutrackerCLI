<?php

namespace BamboV\RutrackerCLI\Add3s3s;

use BamboV\RutrackerAPI\Request;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class Rutracker3s3sRequest extends Request
{
    public function __construct(Request $request)
    {
        parent::__construct($request->getUrl(), $request->getMethod(), $request->getData());
        $this->setCookies($request->getCookies());
    }

    public function getUrl(): string
    {
        $array = explode('.org',parent::getUrl());
        return $array[0].'.org.3s3s.org'.$array[1];
    }

}
