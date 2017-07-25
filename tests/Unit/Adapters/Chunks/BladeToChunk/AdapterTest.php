<?php

namespace Tests\Unit\Adapters\Chunks\BladeToChunk;

use App\Adapters\Chunks\BladeToChunk\Adapter;
use App\Adapters\Exceptions\ChunkDoesNotExistException;
use App\ReChunk;
use App\Chunk;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdapterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Инициализация Adapter.
     */
    public function setUp()
    {
        parent::setUp();
        $this->adapter = new Adapter();
    }

    /** @test */
    public function it_the_existence_of_attribute_a_config()
    {
        $this->assertClassHasAttribute('config', Adapter::class);
    }

    /** @test */
    public function it_the_existence_of_methods()
    {
        $this->assertTrue(method_exists($this->adapter, 'run'));
        $this->assertTrue(method_exists($this->adapter, 'find'));
    }

    /** @test */
    public function it_appearance_of_an_exception_with_incorrect_data()
    {
        $this->expectException(ChunkDoesNotExistException::class);

        $this->adapter->run();
    }

    /** @test */
    public function it_translated_array_into_integer()
    {
        $options = ['1', '1', '0', '1', '1', '0', '1'];
        $expected = 91;

        $this->assertEquals($expected, $this->adapter->translate($options));
    }

    /** @test */
    public function it_returns_a_reformatted_string_from_a_json_array()
    {
        $chunk = create(Chunk::class);
        $rechunk = create(ReChunk::class);

        $this->assertEquals($chunk->body, $this->adapter->toString($rechunk->body));
    }
}
