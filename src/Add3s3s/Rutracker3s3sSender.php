<?php

namespace BamboV\RutrackerCLI\Add3s3s;

use BamboV\RutrackerAPI\GuzzleSender;
use BamboV\RutrackerAPI\Request;
use BamboV\RutrackerAPI\Response;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class Rutracker3s3sSender extends GuzzleSender
{
    /**
     * @param Request $request
     * @param bool $allowRedirect
     *
     * @return Response
     */
    public function send(Request $request, bool $allowRedirect = false): Response
    {
        return parent::send(new Rutracker3s3sRequest($request), $allowRedirect);
    }

}
