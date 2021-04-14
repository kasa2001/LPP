<?php

use Lpp\Service\ItemService;
use Lpp\Service\PriceMaxOrderedBrandService;
use Lpp\Service\UnorderedBrandService;
use Lpp\Validator\ItemValidatorTest;

require "vendor/autoload.php";

$brandService = new UnorderedBrandService(
        new ItemService(
                new ItemValidatorTest()
        )
);
try {
    echo "Unordered brand service\n\n";
    $brands = $brandService->getBrandsForCollection("winter");

    echo "Brands in winter: \n";

    foreach ($brands as $brand) {
        echo $brand->brand . "\n";
    }

    $items = $brandService->getItemsForCollection("winter");

    echo "\nItems in winter Collection: \n";
    foreach ($items as $item) {
        echo $item->name . ". Price: " . $item->getMaxPrices() ."\n";
    }

    $brandService = new PriceMaxOrderedBrandService(
        new ItemService(
            new ItemValidatorTest()
        )
    );

    $items = $brandService->getItemsForCollection("winter");

    echo "\n\nItems in winter Collection (ordered asc by max price): \n";
    foreach ($items as $item) {
        echo $item->name . ". Price: " . $item->getMaxPrices() ."\n";
    }

} catch (Exception $exception) {
    echo $exception->getMessage();
}
