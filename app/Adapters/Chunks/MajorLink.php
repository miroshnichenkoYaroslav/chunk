<?php

namespace App\Adapters\Chunks;

/**
 * Адаптер для мажорной ссылки.
 */
class MajorLink extends Chunk
{
    /**
     *  Адаптер для мажорной ссылки, формирует json, и записывает в БД.
     *
     * @param array $options
     *
     * @return void
     */
    public static function fillJson(array $options): void
    {
        $options['properties'] = MajorLink::complementArray($options['properties']);

        $options['properties'] = MajorLink::reformatProperties($options['properties']);

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
        ];
    }


}