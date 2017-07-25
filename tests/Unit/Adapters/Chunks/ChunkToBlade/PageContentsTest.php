<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\PageContents;
use Tests\TestCase;

class PageContentsTest extends TestCase
{
    /**
     * Автозагрузчик для тестов, инициализуер объект класса PageContents.
     */
    public function setUp()
    {
        parent::setUp();

        $this->content = new PageContents();
    }

    /** @test */
    public function it_the_existence_of_methods()
    {
        $this->assertTrue(method_exists($this->content, 'run'));
        $this->assertTrue(method_exists($this->content, 'toJson'));
        $this->assertTrue(method_exists($this->content, 'reformat'));
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
            'datePublish',
            'lowerLevel',
            'addTitleItalic',
            'onlyFirstPart',
            'not'
        ];

        $actual = array_keys($this->content->reformat($options));

        $this->assertEquals($expected, $actual);
    }


}
