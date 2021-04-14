<?php

namespace Test\Validator;

use Lpp\Entity\Item;
use Lpp\Exception\WrongUrlAddress;
use Lpp\Validator\ItemValidator;
use PHPUnit\Framework\TestCase;

class ItemValidatorTest extends TestCase
{

    private $validator;


    protected function setUp(): void
    {
        $this->validator = new ItemValidator();
    }

    public function testValidObject()
    {

        $result = $this->validator->valid($this->getValidObject());

        $this->assertEquals(0, $result);
    }

    public function testInValidObject()
    {
        $this->expectException(WrongUrlAddress::class);
        $this->validator->valid($this->getInValidObject());
    }

    private function getValidObject(): Item
    {
        return Item::buildFromJson(
            json_decode('{
                    "name": "skirt",
                    "url": "http://www.anotherexample.com",
                    "prices": {
                        "2001": {
                            "description": "Initial price",
                            "priceInEuro": 37,
                            "arrival": "2017-01-01",
                            "due": "2017-01-30"
                        },
                        "2002": {
                            "description": "First promo price",
                            "priceInEuro": 37,
                            "arrival": "2017-01-31",
                            "due": "2017-02-15"
                        }
                    }
                }')
        );
    }

    private function getInValidObject(): Item
    {
        return Item::buildFromJson(
            json_decode('{
                    "name": "skirt",
                    "url": "http://www.111.222.333.444",
                    "prices": {
                        "2001": {
                            "description": "Initial price",
                            "priceInEuro": 37,
                            "arrival": "2017-01-01",
                            "due": "2017-01-30"
                        },
                        "2002": {
                            "description": "First promo price",
                            "priceInEuro": 37,
                            "arrival": "2017-01-31",
                            "due": "2017-02-15"
                        }
                    }
                }')
        );
    }
}