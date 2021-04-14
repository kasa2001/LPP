<?php


namespace Lpp\Service;


use Generator;
use Lpp\Entity\Brand;
use Lpp\Exception\AbstractFileException;
use Lpp\Exception\FileNotExists;
use Lpp\Exception\JsonParseException;
use Lpp\Exception\TooBigFileException;
use Lpp\Exception\WrongUrlAddress;
use Lpp\Validator\ValidatorInterface;

class ItemService implements ItemServiceInterface
{
    /**
     * @var string
     */
    private $dirname;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    private $loggerService;

    public function __construct($validator)
    {
        $this->dirname = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR;
        $this->validator = $validator;
        $this->loggerService = new LoggerService();
    }

    /**
     * @inheritDoc
     * @throws AbstractFileException when something is wrong with file
     */
    public function getResultForCollectionId($collectionId)
    {
        $collection = $this->readJson($collectionId);

        $brands = $this->buildBrandCollection($collection);

        foreach ($brands as $key => $brand) {
            try {
                $this->validateItems($brand);
            } catch (WrongUrlAddress $exception) {
                unset($brands[$key]);
                $this->loggerService->warning($exception);
            }
        }

        return array_values($brands);
    }

    /**
     * @param $collectionId
     * @return mixed
     * @throws AbstractFileException when something is wrong with file
     */
    private function readJson($collectionId)
    {
        $filename = $this->dirname . $collectionId . ".json";

        if (!file_exists($filename)) {
            throw new FileNotExists();
        }

        if (filesize($filename) >= TooBigFileException::FILE_MAX_SIZE) {
            throw new TooBigFileException();
        }

        $parsedJson = json_decode(
            file_get_contents($filename)
        );

        if (json_last_error()) {
            throw new JsonParseException(json_last_error_msg());
        }

        return $parsedJson;
    }

    /**
     * @param $collection
     * @return Brand[]
     */
    private function buildBrandCollection($collection)
    {
        $brands = [];
        foreach ($collection->brands as $brand) {
              $brands[] = Brand::buildFromJson($brand);
        }

        return $brands;
    }

    private function validateItems($brand)
    {
        foreach ($brand->getItems() as $item) {
            $this->validator->valid($item);
        }
    }
}