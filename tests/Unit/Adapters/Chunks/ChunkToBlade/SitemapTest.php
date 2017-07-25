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

    /** @test */
    public function it_the_existence_of_methods()
    {
        $this->assertTrue(method_exists($this->map, 'run'));
        $this->assertTrue(method_exists($this->map, 'toJson'));
        $this->assertTrue(method_exists($this->map, 'reformat'));
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
        ];

        $expected = [
            'description',
            'list',
            'number',
            'datePublish',
            'descOnNewLine',
            'notRootPage',
            'onlyFirstPart',
            'includePages',
            'notIncludeLast',
            'shortTitle'
        ];

        $actual = array_keys($this->map->reformat($options));

        $this->assertEquals($expected, $actual);
    }
}
