<?php

namespace Tests\Unit;

use App\Chunks\ChunkManager;
use Tests\TestCase;

class ChunkManagerTest extends TestCase
{
    /**
     * @var ChunkManager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $settings;

    public function setUp()
    {
        $this->manager = new ChunkManager();
        $this->settings = 'user:link:top';
    }

    /** @test */
    public function testAddMethod()
    {
        // Проверяем наличие метода в классе
        $this->assertTrue(method_exists(ChunkManager::class, 'add'));

        $this->manager->add($this->settings);

        // Проверяем добавление записи в контейнер
        $this->assertCount(1, $this->manager->get());
    }

    /** @test */
    public function testShowMethod()
    {
        // Проверяем наличие метода в классе
        $this->assertTrue(method_exists(ChunkManager::class, 'show'));

        $this->manager->add($this->settings);
        $string = '<a href="#">Link</a>';

        // Проверяем результат работы метода - возращает необходимый чанк
        $this->assertEquals($string, $this->manager->show($this->settings));
    }
}