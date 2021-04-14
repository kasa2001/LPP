<?php
namespace Lpp\Entity;

/**
 * Represents a single brand in the result.
 *
 */
class Brand
{
    /**
     * Name of the brand
     *
     * @var string
     */
    public $brand;

    /**
     * Brand's description
     * 
     * @var string
     */
    public $description;

    /**
     * Unsorted list of items with their corresponding prices.
     * 
     * @var Item[]
     */
    public $items = [];

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    public static function buildFromJson($jsonBrand)
    {
        $brand = new Brand();
        $brand->brand = $jsonBrand->name;
        $brand->description = $jsonBrand->description;

        foreach ($jsonBrand->items as $item) {
            $brand->items[] = Item::buildFromJson($item);
        }

        return $brand;
    }

}
