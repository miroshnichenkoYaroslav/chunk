<?php

namespace App\Adapters\Chunks\ChunkToBlade;

// TODO: поправить описание
/**
 * Класс, в котором реализован метод fillJson.
 */
abstract class Chunk
{
    // TODO: тупое описание
    /**
     *  Адаптер для чанка(умного элемента), который формирует json,
     *  записывая данные в БД.
     *
     * @param array $options
     *
     * @return void
     */
    abstract public function fillJson(array $options): void;

    /**
     * Формирует ассоциативный массив.
     *
     * @param array $properties
     *
     * @return array
     */
    abstract public function reformatProperties(array $properties): array;

    /**
     * Переводит значение в двоичную строку, разбивает строку по символу,
     * переворачивает массив.
     *
     * @param string $properties
     *
     * @return array
     */
    public function complementArray(string $properties): array // TODO: нормальное название метода
    {
        $properties = base_convert($properties, 10, 2);

        return array_reverse(str_split($properties));
    }
}
