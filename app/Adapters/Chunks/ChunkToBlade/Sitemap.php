<?php

namespace App\Adapters\Chunks\ChunkToBlade;

/**
 * Адаптер для карты сайта.
 */
class Sitemap extends Chunk
{

    /**
     * Запускаем работу Sitemap.
     *
     * @param array $options
     *
     * @return string
     */
    public function run(array $options): string
    {
        $bits = $this->retrieveBits($options['properties']);
        $options['properties'] = $this->reformat($bits);

        return $this->toJson($options);
    }

    /**
     *  Формирует json.
     *
     * @param array $options
     *
     * @return string
     */
    public function toJson(array $options): string
    {
        return json_encode($options);
    }

    /**
     * Формирует ассоциативный массив.
     *
     * @param array $properties
     *
     * @return array
     */
    public function reformat(array $properties): array
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
