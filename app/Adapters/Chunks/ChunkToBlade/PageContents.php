<?php

namespace App\Adapters\Chunks\ChunkToBlade;

use Psr\Log\InvalidArgumentException;

class PageContents extends Chunk
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
     * @return array
     */
    public function reformatProperties(array $properties): array
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


