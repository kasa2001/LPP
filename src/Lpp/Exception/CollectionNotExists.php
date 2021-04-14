<?php

namespace Lpp\Exception;

use Exception;

class CollectionNotExists extends Exception
{
    const COLLECTION_NOT_EXISTS_DEFAULT_MESSAGE = 'Collection not exists';
    const COLLECTION_NOT_EXISTS_CODE = 1;

    public function __construct(
        $message = CollectionNotExists::COLLECTION_NOT_EXISTS_DEFAULT_MESSAGE,
        $code = CollectionNotExists::COLLECTION_NOT_EXISTS_CODE,
        $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}