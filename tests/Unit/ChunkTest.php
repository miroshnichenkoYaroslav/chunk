<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Blade;
use Mockery as m;
use Illuminate\View\Compilers\BladeCompiler;
use Tests\TestCase;

class ChunkTest extends TestCase
{
    /**
     * @test
     */
    public function testCustomExtensionOverwritesCore()
    {
        $compiler = new BladeCompiler($this->getFiles(), __DIR__);
        $compiler->directive('chunk', function ($expression) {
            return '<?php custom(); ?>';
        });

        $string = '@chunk';
        $expected = '<?php custom(); ?>';

        $this->assertEquals($expected, $compiler->compileString($string));

        $path = __DIR__.'/../output/welcome.blade.php';
        dd($path);
        $res = $compiler->compile($path);
    }

    /**
     * @return m\MockInterface
     */
    protected function getFiles()
    {
        return m::mock('Illuminate\Filesystem\Filesystem');
    }


}