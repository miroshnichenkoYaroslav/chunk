<?php

namespace App\Chunks;

use Illuminate\Contracts\View\Factory;

class Link extends Chunk
{
    /**
     * Создание чанка.
     *
     * @param $name
     *
     * @return string
     */
    public function make($name): string
    {
        return app(Factory::class)->make('chunks.' . $name)->render();
    }
}