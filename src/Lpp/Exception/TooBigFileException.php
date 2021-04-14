<?php

namespace Lpp\Exception;

class TooBigFileException extends AbstractFileException
{

    public function __construct(
        $message = AbstractFileException::TOO_BIG_FILE_DEFAULT_MESSAGE,
        $code = AbstractFileException::TOO_BIG_FILE_CODE,
        $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}