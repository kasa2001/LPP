<?php

namespace Lpp\Entity;

use DateTime;

/**
 * Represents a single price from a search result
 * related to a single item.
 * 
 */
class Price
{
    /**
     * Description text for the price
     * 
     * @var string
     */
    public $description;

    /**
     * Price in euro
     * 
     * @var int
     */
    public $priceInEuro;

    /**
     * Warehouse's arrival date (to)
     *
     * @var DateTime
     */
    public $arrivalDate;

    /**
     * Due to date,
     * defining how long will the item be available for sale (i.e. in a collection)
     *
     * @var DateTime
     */
    public $dueDate;

    public static function buildFromJson($jsonPrice)
    {
        $price = new Price();
        $price->description = $jsonPrice->description;
        $price->priceInEuro = $jsonPrice->priceInEuro;
        $price->arrivalDate = DateTime::createFromFormat("YYYY-MM-DD", $jsonPrice->arrival);
        $price->dueDate = DateTime::createFromFormat("YYYY-MM-DD", $jsonPrice->due);

        return $price;
    }
}
