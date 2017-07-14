<?php

namespace App\Chunks;

abstract class Chunk
{
    /**
     * Создание чанка.
     *
     * @param $name
     *
     * @return string
     */
    abstract public function make($name): string;
}