<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\Adapter;
use App\Adapters\Exceptions\ChunkDoesNotExistException;
use App\Chunk;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdapterTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * Автозагрузчик для тестов, инициализует объект класса Adapter.
     */
    public function setUp()
    {
        parent::setUp();
        $this->adapter = new Adapter();
    }

    /** @test */
    public function it_appearance_of_an_exception_with_incorrect_data()
    {
        $this->expectException(ChunkDoesNotExistException::class);

        $this->adapter->run();
    }

    public function it_the_existence_of_attribute_a_config()
    {
        $this->assertClassHasAttribute('config', Adapter::class);
    }

    /** @test */
    public function it_the_existence_of_methods()
    {
        $this->assertTrue(method_exists($this->adapter,
            'run'));
        $this->assertTrue(method_exists($this->adapter,
            'find'));
        $this->assertTrue(method_exists($this->adapter,
            'handleType'));
        $this->assertTrue(method_exists($this->adapter,
            'fillConfigs'));
        $this->assertTrue(method_exists($this->adapter,
            'transfer'));
        $this->assertTrue(method_exists($this->adapter,
            'reformatConfigs'));
        $this->assertTrue(method_exists($this->adapter,
            'save'));
    }

    /** @test */
    public function it_verification_of_receipt_of_data()
    {
        $options = [
           'pageId' => '0B395229691F49ADB8454984CA818F45',
           'type' => '1',
            'properties' => [
                'datePublish' => '0',
                'addToContent' => false,
                'onlyFirstPart' => false
            ],
           'nested' => '0',
           'allLevelsDown' => '0',
           'rowsLimit' => '0',
           'order' => '0',
           'dateFromCheck' => '0',
           'dateToCheck' => '0',
           'dateFrom' => '30.04.2013',
           'dateTo' => '30.04.2013',
           'pagination' => '0',
           'rowsPerPage' => '0',
           'category' => '0',
           'linkType' => '0',
           'nameLink' => false,
           'iconWidth' => false,
           'iconHeight' => false,
           'listPages' => false,
           'file' => false,
        ];
        $chunk = create(Chunk::class);

        $this->adapter->handleType($chunk);

        $this->assertEquals(json_encode($options), $this->adapter->getConfig()['body']);
    }
}
