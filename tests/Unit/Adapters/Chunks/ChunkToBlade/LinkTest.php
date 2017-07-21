<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\Link;
use Tests\TestCase;

class LinkTest extends TestCase
{

    /**
     * Автозагрузчик для тестов, инициализуер объект класса Link.
     */
    public function setUp()
    {
        parent::setUp();

        $this->link = new Link();
    }

    /** @test */
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

        $this->assertEquals($options, $this->link->retrieveBits('91'));
    }

    /** @test */
    public function it_get_reformatted_array()
    {
        $options = [
            0 => "1",
            1 => "1",
        ];

        $expected = [
            'datePublish',
            'addToContent',
            'onlyFirstPart'
        ];

        $actual = array_keys($this->link->reformat($options));

        $this->assertEquals($expected, $actual);
    }

}
