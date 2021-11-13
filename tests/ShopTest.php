<?php

use \PHPUnit\Framework\TestCase;


class ShopTest extends TestCase
{
    /**
     * @dataProvider providerProperties
     */

    public function testGetProductProperties($key)
    {
        $product = \app\models\Products::getOne(3);
        $this->assertObjectHasAttribute($key, $product);
    }

    public function providerProperties()
    {
        return array(
            array('id'),
            array('name'),
            array('description'),
            array('props'),
            array('price'),
            array('category_id')
        );
    }
}