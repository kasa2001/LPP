<?php
namespace Lpp\Entity;

/**
 * Represents a single item from a search result.
 * 
 */
class Item
{
    /**
     * Name of the item
     *
     * @var string
     */
    public $name;

    /**
     * Url of the item's page
     * 
     * @var string
     */
    public $url;

    /**
     * Unsorted list of prices received from the 
     * actual search query.
     * 
     * @var Price[]
     */
    public $prices = [];

    public static function buildFromJson($jsonItem)
    {
        $item = new Item();
        $item->name = $jsonItem->name;
        $item->url = $jsonItem->url;

        foreach ($jsonItem->prices as $price) {
            $item->prices[] = Price::buildFromJson($price);
        }

        return $item;
    }

    public function getMaxPrices()
    {
        $priceToReturn = 0;

        foreach ($this->prices as $price) {
            if ($priceToReturn < $price->priceInEuro) {
                $priceToReturn = $price->priceInEuro;
            }
        }

        return $priceToReturn;
    }


}
