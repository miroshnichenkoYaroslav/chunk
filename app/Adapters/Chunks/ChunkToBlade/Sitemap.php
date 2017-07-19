<?php

namespace App\Adapters\Chunks\ChunkToBlade;

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
        $options['properties'] = $this->complementArray($options['properties']);

        $options['properties'] = $this->reformatProperties($options['properties']);

        //TODO return|send (json_encode($options) in API
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
            'notRootPage'    => $properties[5] ?? false,
            'onlyFirstPart'  => $properties[6] ?? false,
            'includePages'   => $properties[7] ?? false,
            'notIncludeLast' => $properties[8] ?? false,
            'shortTitle'     => $properties[9] ?? false,
        ];
    }


}