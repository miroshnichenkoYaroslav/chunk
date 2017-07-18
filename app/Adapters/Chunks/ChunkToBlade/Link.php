<?php

namespace App\Adapters\Chunks\ChunkToBlade;

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
        $options['properties'] = $this->complementArray($options['properties']);

        $options['properties'] = $this->reformatProperties($options['properties']);

        //TODO генерировать html из готового массива.
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
     * @return array $properties
     */
    public function reformatProperties(array $properties): array
    {
        return [
            'datePublish' => $properties[0],
            'addToContent' => $properties[1],
            'onlyFirstPart' => $properties[2],
            'not' => [
                $properties[3],
                $properties[4],
                $properties[5],
                $properties[6]
            ]
        ];
    }

}