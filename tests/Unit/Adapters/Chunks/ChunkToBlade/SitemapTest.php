<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\Adapter;
use App\Adapters\Chunks\ChunkToBlade\Sitemap;
use App\Chunk;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SitemapTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Автозагрузчик для тестов, инициализуер объект класса Sitemap.
     */
    public function setUp()
    {
        parent::setUp();
        $this->map = new Sitemap();
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
        ];

        $this->assertArrayHasKey('description', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('list', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('number', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('datePublish', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('descOnNewLine', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('notRootPage', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('onlyFirstPart', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('includePages', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('notIncludeLast', $this->map->reformatProperties($options));
        $this->assertArrayHasKey('shortTitle', $this->map->reformatProperties($options));
    }
}
