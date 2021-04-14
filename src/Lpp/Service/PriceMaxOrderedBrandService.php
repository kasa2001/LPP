<?php


namespace Lpp\Service;


use Lpp\Entity\Item;

class PriceMaxOrderedBrandService extends UnorderedBrandService
{

    /**
     * @param $items Item[]
     * @return null
     */
    protected function orderBy($items)
    {
        usort($items, [$this, "priceSort"]);

        return $items;
    }

    /**
     * @param $item Item
     * @param $item2 Item
     * @return int
     */
    public function priceSort($item, $item2)
    {
        $price = $item->getMaxPrices();

        $price2 = $item2->getMaxPrices();

        return $price > $price2 ? 1 : -1;
    }

}