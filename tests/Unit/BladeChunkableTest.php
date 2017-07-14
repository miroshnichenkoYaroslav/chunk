<?php

namespace Tests\Unit;

use Mockery as m;
use Illuminate\View\Compilers\BladeCompiler;
use Tests\TestCase;

/**
 * Class BladeChunkableTest
 * @package Tests\Unit
 */
class BladeChunkableTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /** @test */
    public function testChunkableDirective()
    {
        $settings = 'user:link:left';
        $compiler = new BladeCompiler($this->getFiles(), __DIR__);

        // Проверяем, что не создано кастомных директив.
        $this->assertCount(0, $compiler->getCustomDirectives());

        $compiler->directive('chunkable', function () use($settings) {
            return "<?php Facades\App\Chunks\ChunkManager::show($settings) ?>";
        });

        // Проверяем, что добавилась кастомная директива.
        $this->assertCount(1, $compiler->getCustomDirectives());

        $string = '@chunkable';
        $expected = "<?php Facades\App\Chunks\ChunkManager::show($settings) ?>";

        // Проверяем, что директива возвращает необходимое значение.
        $this->assertEquals($expected, $compiler->compileString($string));
    }

    /**
     * получение массива
     *
     * @return m\MockInterface
     */
    protected function getFiles()
    {
        return m::mock('Illuminate\Filesystem\Filesystem');
    }
}