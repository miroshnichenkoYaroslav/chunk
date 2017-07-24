<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\Adapter;
use App\Adapters\Exceptions\ChunkDoesNotExistException;
use App\Adapters\Exceptions\ChunkTypeDoesNotExistException;
use App\Chunk;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery as m;

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

    /**
     * Моки.
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /** @test */
    public function it_appearance_of_an_exception_with_incorrect_data()
    {
        $this->expectException(ChunkDoesNotExistException::class);

        $this->adapter->run();
    }

    /** @test */
    public function it_verification_of_receipt_of_data()
    {
        $options = [
           'pageId' => '0538681A07E04232B31995A17FBC1CBB',
           'type' => '1',
            'properties' => [
                'datePublish' => '1',
                'addToContent' => '1',
                'onlyFirstPart' =>'0'
            ],
           'nested' => '1',
           'allLevelsDown' => '0',
           'rowsLimit' => '0',
           'order' => '0',
           'dateFromCheck' => '0',
           'dateToCheck' => '0',
           'dateFrom' => '13.05.2013',
           'dateTo' => '13.05.2013',
           'pagination' => '1',
           'rowsPerPage' => '2',
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
