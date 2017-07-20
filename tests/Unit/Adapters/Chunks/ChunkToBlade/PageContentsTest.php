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

        // TODO: вынести все в один метод
        $this->assertArrayHasKey('datePublish', $this->content->reformatProperties($options));
        $this->assertArrayHasKey('lowerLevel', $this->content->reformatProperties($options));
        $this->assertArrayHasKey('addTitleItalic', $this->content->reformatProperties($options));
        $this->assertArrayHasKey('onlyFirstPart', $this->content->reformatProperties($options));
        $this->assertArrayHasKey('not', $this->content->reformatProperties($options));
    }
}
