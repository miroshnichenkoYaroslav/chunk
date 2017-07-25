<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\ProductsCatalog;
use Tests\TestCase;

class ProductsCatalogTest extends TestCase
{
    /**
     * Инициализация экземпляра класса ProductsCatalog.
     */
    public function setUp()
    {
        parent::setUp();

        $this->catalog = new ProductsCatalog();
    }

    /** @test */
    public function it_the_existence_of_methods()
    {
        $this->assertTrue(method_exists($this->catalog, 'run'));
        $this->assertTrue(method_exists($this->catalog, 'toJson'));
        $this->assertTrue(method_exists($this->catalog, 'reformat'));
    }

    /** @test */
    public function it_get_reformatted_array()
    {
        $options = [
            0 => "1",
            1 => "1",
            2 => "0",
            3 => "1",
            4 => "0",
            5 => "0",
            6 => "0"
        ];

        $expected = [
            'allowPrice',
            'submitButton',
            'multiOrder',
            'oldPrice',
            'withoutPrice',
            'zeroBalance',
            'userChoice'
        ];

        $actual = array_keys($this->catalog->reformat($options));

        $this->assertEquals($expected, $actual);
    }
}