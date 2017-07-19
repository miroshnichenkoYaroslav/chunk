<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\ProductsCatalog;
use Tests\TestCase;

class ProductsCatalogTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->catalog = new ProductsCatalog();
    }

    /**
     * @test
     */
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

        $this->assertArrayHasKey('allowPrice', $this->catalog->reformatProperties($options));
        $this->assertArrayHasKey('submitButton', $this->catalog->reformatProperties($options));
        $this->assertArrayHasKey('multiOrder', $this->catalog->reformatProperties($options));
        $this->assertArrayHasKey('oldPrice', $this->catalog->reformatProperties($options));
        $this->assertArrayHasKey('withoutPrice', $this->catalog->reformatProperties($options));
        $this->assertArrayHasKey('zeroBalance', $this->catalog->reformatProperties($options));
        $this->assertArrayHasKey('userChoice', $this->catalog->reformatProperties($options));
    }
}