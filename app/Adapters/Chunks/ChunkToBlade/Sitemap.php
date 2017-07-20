<?php

namespace App\Adapters\Chunks\ChunkToBlade;

/**
 * Адаптер для карты сайта.
 */
class Sitemap extends Chunk
{

    // TODO: ыфва
    public function __construct (array $options = []) {
        // $options = $this->prepareOptions($options)
        $this-fillJson($options);
    }

    /**
     *  Адаптер для карты сайта, формирует json, и записывает в БД.
     *
     * @param array $options
     *
     * @return void
     */
    public function fillJson(array $options): void // TODO: придумать нормальное название
    {
        $tmp = $this->complementArray($options['properties']); // TODO: переименовать переменную

        $options['properties'] = $this->reformatProperties($tmp);

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
