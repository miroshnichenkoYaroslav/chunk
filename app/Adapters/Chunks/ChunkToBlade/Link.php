<?php

namespace App\Adapters\Chunks\ChunkToBlade;

/**
 * Адаптер для карты сайта.
 */
class Link extends Chunk
{

    /**
     * Запускает работу Link.
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
            'addToContent' => $properties[1] ?? false,
            'onlyFirstPart' => $properties[2] ?? false,
        ];
    }
}

