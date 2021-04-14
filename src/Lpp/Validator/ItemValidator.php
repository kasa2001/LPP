<?php


namespace Lpp\Validator;


use InvalidArgumentException;
use Lpp\Exception\WrongUrlAddress;

class ItemValidator implements ValidatorInterface
{
    /**
     * URL Pattern
     *
     * Requirements for url:
     * 1) Pattern accept only http or https protocols (url must have protocol name)
     * 2) Pattern do not accept authorize between protocol and host name
     * 3) Before host name can be World Wide Web shortcut
     */
    const URL_PATTERN = "/^(http(s?)):\/\/(((www\.)?[a-z0-9]+[\.\-][a-z0-9\.\-\_]+[a-z]))/i";

    /**
     * @param $item
     * @throws WrongUrlAddress
     */
    function valid($item)
    {
        if (!preg_match(ItemValidator::URL_PATTERN, $item->url)) {
            throw new WrongUrlAddress(
                WrongUrlAddress::WRONG_URL_ADDRESS_DEFAULT_MESSAGE,
                WrongUrlAddress::WRONG_URL_ADDRESS_CODE,
                new InvalidArgumentException(sprintf("Item with url: %s has wrong url address", $item->url))
            );
        }

        return 0;
    }

}