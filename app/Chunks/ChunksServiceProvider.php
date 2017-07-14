<?php

namespace App\Chunks;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * регистрирует кастомные дерективы
 *
 * Class ChunksServiceProvider
 */
class ChunksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // используется как @chunk('user:link:left')
        Blade::directive('chunk', function ($settings){
            return "<?php Facades\App\Chunks\ChunkManager::add($settings) ?>";
        });

        // используется как @chunkable('user:link:left')
        Blade::directive('chunkable', function ($settings){
            return "<?php echo Facades\App\Chunks\ChunkManager::show($settings) ?>";
        });
    }
}