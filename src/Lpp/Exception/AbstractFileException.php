<?php


namespace Lpp\Exception;


use Exception;

abstract class AbstractFileException extends Exception
{
    /**
     * Messages
     */
    const TOO_BIG_FILE_DEFAULT_MESSAGE = 'File is too big. Possible file size is 512kb';
    const FILE_NOT_EXISTS_DEFAULT_MESSAGE = 'File not exists in directory data';
    const JSON_PARSE_EXCEPTION_DEFAULT_MESSAGE = 'Error while parsing json file';

    /**
     * Codes
     */
    const TOO_BIG_FILE_CODE = 2;
    const FILE_NOT_EXISTS_CODE = 3;
    const JSON_PARSE_EXCEPTION_CODE = 4;

    const FILE_MAX_SIZE = 524288;
}