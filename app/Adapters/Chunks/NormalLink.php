<?php

namespace App\Adapters\Chunks;

/**
 * Адаптер для нормальной ссылки.
 */
class NormalLink extends Chunk
{
    /**
     *  Адаптер для нормальной ссылки, формирует json, и записывает в БД.
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
     * Переводить значение в двоичную строку
     *
     * @param string $properties
     *
     * @return array
     */
    public static function complementArray(string $properties): array
    {
        $properties = base_convert($properties, 10, 2);
        $properties = str_split($properties);
        $properties = array_reverse($properties);

        for ($i = 0; $i < 10; $i++) {
            $properties[$i] =  $properties[$i] ?? 0;
        }

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
            'dataPublish' => $properties[0],
            'addToContent' => $properties[1],
            'onlyFirstPart' => $properties[2]
        ];
    }


}