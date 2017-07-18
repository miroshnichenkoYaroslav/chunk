<?php

namespace App\Adapters\Chunks;

/**
 * Адаптер для карты сайта.
 */
class Sitemap extends Chunk
{
    /**
     *  Адаптер для карты сайта, формирует json, и записывает в БД.
     *
     * @param array $options
     *
     * @return void
     */
    public function fillJson(array $options): void
    {
        $options['properties'] = Sitemap::complementArray($options['properties']);

        $options['properties'] = Sitemap::reformatProperties($options['properties']);

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
    public function complementArray(string $properties): array
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
    public function reformatProperties(array $properties): array
    {
        return [
            'description'    => $properties[0],
            'list'           => $properties[1],
            'number'         => $properties[2],
            'datePublish'    => $properties[3],
            'descOnNewLine'  => $properties[4],
            'notRootPage'    => $properties[5],
            'onlyFirstPart'  => $properties[6],
            'includePages'   => $properties[7],
            'notIncludeLast' => $properties[8],
            'shortTitle'     => $properties[9],
        ];
    }


}