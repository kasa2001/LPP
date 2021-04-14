<?php


namespace Lpp\Exception;


class FileNotExists extends AbstractFileException
{

    public function __construct(
        $message = AbstractFileException::FILE_NOT_EXISTS_DEFAULT_MESSAGE,
        $code = AbstractFileException::FILE_NOT_EXISTS_CODE,
        $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}