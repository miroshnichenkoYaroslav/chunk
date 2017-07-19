<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\Link;
use Tests\TestCase;

class LinkTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->link = new Link();
    }
    /**
     * @test
     */
    public function it_conversion_of_a_number_to_a_binary_system()
    {
        $options = [
            0 => "1",
            1 => "1",
            2 => "0",
            3 => "1",
            4 => "1",
            5 => "0",
            6 => "1",
        ];

        $this->assertEquals($options, $this->link->complementArray('91'));
    }

    /**
     * @test
     */
    public function it_get_reformatted_array()
    {
        $options = [
            0 => "1",
            1 => "1",
        ];

        $this->assertArrayHasKey('datePublish', $this->link->reformatProperties($options));
        $this->assertArrayHasKey('addToContent', $this->link->reformatProperties($options));
        $this->assertArrayHasKey('onlyFirstPart', $this->link->reformatProperties($options));
    }

}
