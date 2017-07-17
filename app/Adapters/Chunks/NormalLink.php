<?php

namespace App\Adapters\Chunks;

/**
 * Адаптер для нормальной ссылки.
 */
class NormalLink extends Chunk
{
    /**
     *  Адаптер для чанка(умного элемента), который формирует json,
     *  записывая данные в БД.
     *
     * @param array $options
     *
     * @return void
     */
    public static function fillJson(array $options): void
    {
        $options['properties'] = NormalLink::complementArray($options['properties']);

        $options['properties'] = NormalLink::reformatProperties($options['properties']);

        //TODO return|send (json_encode($options) in API
    }

    /**
     * Переводит значение в двоичную строку, разбивает строку по символу,
     * переворачивает массив.
     *
     * @param string $properties
     *
     * @return array
     */
    public static function complementArray(string $properties): array
    {
        $properties = base_convert($properties, 10, 2);
        $properties = array_reverse(str_split($properties));

        return $properties;
    }

    /**
     * Формирует ассоциативный массив.
     *
     * @param array $properties
     *
     * @return array
     */
    public static function reformatProperties(array $properties): array
    {
        return [
            'datePublish' => $properties[0],
            'addToContent' => $properties[1],
            'onlyFirstPart' => $properties[2]
        ];
    }


}