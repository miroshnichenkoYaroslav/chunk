<?php

namespace App\Adapters\Chunks\ChunkToBlade;

// TODO: поправить описание

/**
 * Класс, в котором реализован метод fillJson.
 */
abstract class Chunk
{
    /**
     * Формирует json.
     *
     * @param array $options
     *
     * @return string
     */
    abstract public function toJson(array $options): string;

    /**
     * Формирует ассоциативный массив.
     *
     * @param array $properties
     *
     * @return array
     */
    abstract public function reformat(array $properties): array;

    /**
     * Переводит значение в двоичную строку, разбивает строку по символу,
     * переворачивает массив.
     *
     * @param string $properties
     *
     * @return array
     */
    public function retrieveBits(string $properties): array
    {
        $properties = base_convert($properties, 10, 2);

        return array_reverse(str_split($properties));
    }
}
