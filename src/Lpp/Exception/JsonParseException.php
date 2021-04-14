<?php


namespace Lpp\Exception;


class JsonParseException extends AbstractFileException
{

    public function __construct(
        $message = AbstractFileException::JSON_PARSE_EXCEPTION_DEFAULT_MESSAGE,
        $code = AbstractFileException::JSON_PARSE_EXCEPTION_CODE,
        $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}