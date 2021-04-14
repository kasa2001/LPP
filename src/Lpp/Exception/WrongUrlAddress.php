<?php


namespace Lpp\Exception;


use Exception;

class WrongUrlAddress extends Exception
{

    const WRONG_URL_ADDRESS_DEFAULT_MESSAGE = "Url pattern cannot match URL address. Requirements for url address:\n
                1) Pattern accept only http or https protocols (url must have protocol name)\n
                2) Pattern do not accept authorize between protocol and host name\n
                3) Before host name can be World Wide Web shortcut\n
                All brand was ignored\n";

    const WRONG_URL_ADDRESS_CODE = 5;

    public function __construct(
        $message = WrongUrlAddress::WRONG_URL_ADDRESS_DEFAULT_MESSAGE,
        $code = WrongUrlAddress::WRONG_URL_ADDRESS_CODE,
        $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}