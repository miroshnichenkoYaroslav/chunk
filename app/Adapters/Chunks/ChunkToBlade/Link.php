<?php

namespace App\Adapters\Chunks\ChunkToBlade;

use Psr\Log\InvalidArgumentException;

/**
 * Адаптер для нормальной и мажорной ссылок.
 */
class Link extends Chunk
{

    /**
     *  Адаптер для чанка(умного элемента), который формирует json,
     *  записывая данные в БД.
     *
     * @param array $options
     *
     * @return void
     */
    public function fillJson(array $options): void
    {
        if ($options === null) {
            throw new InvalidArgumentException('Переданны неверные данные.');
        }

        $options['properties'] = $this->complementArray($options['properties']);

        $options['properties'] = $this->reformatProperties($options['properties']);

        //TODO генерировать html из готового массива.
    }

    /**
     * Формирует ассоциативный массив.
     *
     * @param array $properties
     *
     * @return array $properties
     */
    public function reformatProperties(array $properties): array
    {
        return [
            'datePublish' => $properties[0],
            'addToContent' => $properties[1] ?? false,
            'onlyFirstPart' => $properties[2] ?? false,
        ];
    }

}