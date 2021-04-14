<?php


namespace Lpp\Service;

use Exception;

class LoggerService
{
    /**
     * @param $exception Exception
     */
    public function warning($exception)
    {
        file_put_contents("warning.log", $exception, FILE_APPEND);
    }
}