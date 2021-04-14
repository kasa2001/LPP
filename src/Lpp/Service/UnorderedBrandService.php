<?php

namespace Lpp\Service;


use Lpp\Entity\Brand;
use Lpp\Exception\CollectionNotExists;

class UnorderedBrandService implements BrandServiceInterface
{
    /**
     * @var ItemServiceInterface
     */
    private $itemService;

    /**
     * Maps from collection name to the id for the item service.
     *
     * @var array
     */
    private $collectionNameToIdMapping = [
        "winter" => 1315475
    ];

    /**
     * @param ItemServiceInterface $itemService
     */
    public function __construct(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @param string $collectionName Name of the collection to search for.
     *
     * @return Brand[]
     * @throws CollectionNotExists
     */
    public function getBrandsForCollection($collectionName)
    {
        $this->checkCollectionExist($collectionName);

        $collectionId = $this->collectionNameToIdMapping[$collectionName];
        return $this->itemService->getResultForCollectionId($collectionId);
    }


    /**
     * This is supposed to be used for testing purposes.
     * You should avoid replacing the item service at runtime.
     *
     * @param ItemServiceInterface $itemService
     *
     * @return void
     */
    public function setItemService(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @inheritDoc
     * @throws CollectionNotExists
     */
    public final function getItemsForCollection($collectionName)
    {
        $this->checkCollectionExist($collectionName);

        $collectionId = $this->collectionNameToIdMapping[$collectionName];
        $brands = $this->itemService->getResultForCollectionId($collectionId);

        $items = $this->getItemsFromBrands($brands);

        return $this->orderBy($items);
    }

    /**
     * @param $collectionName
     * @throws CollectionNotExists
     */
    private function checkCollectionExist($collectionName)
    {
        if (empty($this->collectionNameToIdMapping[$collectionName])) {
            throw new CollectionNotExists(sprintf('Provided collection name [%s] is not mapped.', $collectionName));
        }
    }

    private function getItemsFromBrands($brands)
    {
        $items = [];

        foreach($brands as $brand) {
            $items = array_merge($items, $brand->getItems());
        }

        return $items;
    }

    protected function orderBy($items)
    {
        return $items;
    }
}
