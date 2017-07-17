<?php

namespace App\Adapters\Chunks;

/**
 * Класс, в котором реализован метод fillJson.
 */
abstract class Chunk
{
    /**
     *  Адаптер для чанка(умного элемента), который формирует json,
     *  записывая данные в БД.
     *
     * @param array $options
     *
     * @return void
     */
    abstract public static function fillJson(array $options): void;

    /**
     * Переводит значение в двоичную строку, разбивает строку по символу,
     * переворачивает массив.
     *
     * @param string $properties
     *
     * @return array
     */
    abstract public static function complementArray(string $properties): array;

    /**
     * Формирует ассоциативный массив.
     *
     * @param array $properties
     *
     * @return array
     */
    abstract public static function reformatProperties(array $properties): array;
}