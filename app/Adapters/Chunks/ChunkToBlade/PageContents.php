<?php

namespace App\Adapters\Chunks\ChunkToBlade;

/**
 * Адаптер для карты сайта.
 */
class PageContents extends Chunk
{

    /**
     * Запускает работу PageContents.
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
            'datePublish' => $properties[0],
            'lowerLevel'     => $properties[1],
            'addTitleItalic' => $properties[2],
            'onlyFirstPart'  => $properties[3],
            'not' => [
                $properties[4] ?? false,
                $properties[5] ?? false,
                $properties[6] ?? false,
            ]

        ];
    }
}


