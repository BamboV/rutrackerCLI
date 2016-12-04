<?php

namespace BamboV\RutrackerCLI\Exceptions;

use Exception;


/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class RutrackerFileIOException extends RutrackerCLIException
{
    public function __construct($message = 'File not found', $code=0, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}
