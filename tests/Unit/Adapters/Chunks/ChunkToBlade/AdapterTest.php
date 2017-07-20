<?php

namespace Tests\Unit\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Chunks\ChunkToBlade\Adapter;
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
    /**
     * @test
     */
    public function it_appearance_of_an_exception_with_incorrect_data()
    {
        $this->expectExceptionMessage('Переданны неверные данные.'); // TODO: заменить на SomeExceptionBlaBla::class

        $this->adapter->init();
    }

    /** @test */ // TODO: делать вот так
    public function it_verification_of_receipt_of_data()
    {
        $options = [
            "pageId" => "0538681A07E04232B31995A17FBC1CBB", // TODO: заменить на одинарные ковычки
            "type" => "1",
            "properties" => "91",
            "nested" => "1",
            "allLevelsDown" => "0",
            "rowsLimit" => "0",
            "order" => "0",
            "dateFromCheck" => "0",
            "dateToCheck" => "0",
            "dateFrom" => "13.05.2013",
            "dateTo" => "13.05.2013",
            "pagination" => "1",
            "rowsPerPage" => "2",
            "category" => "0",
            "linkType" => "0",
            "nameLink" => false,
            "iconWidth" => false,
            "iconHeight" => false,
            "listPages" => false,
            "file" => false,
        ];
        //$adapter = new Adapter();
        $row = factory(Chunk::class)->create(); // TODO: переименовать в chunk
        // $row = create(Chunk::class); TODO: добавить хелперы

        $this->adapter->dataProcessing($row);
        $this->assertEquals($options, $this->adapter->getContainer());
    }

    /**
     * @test
     */
    public function it_correctness_of_line_break()
    {
        $row = factory(Chunk::class)->create();

        $options = [
            0 => "0538681A07E04232B31995A17FBC1CBB",
            1 => "1",
            2 => "91",
            3 => "1",
            4 => "0",
            5 => "0",
            6 => "0",
            7 => "0",
            8 => "0",
            9 => "0",
            10 => "13.05.2013",
            11 => "13.05.2013",
            12 => "1",
            13 => "2",
            14 => "0",
            15 => "0",
            16 => "0",
            17 => "0",
            18 => "0"
        ];
        $this->adapter->fillContainer($row->body);

        $this->assertEquals($options, $this->adapter->getContainer());
    }
}
