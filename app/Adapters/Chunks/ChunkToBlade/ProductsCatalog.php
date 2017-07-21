<?php

namespace App\Adapters\Chunks\ChunkToBlade;

/**
 * Адаптер для карты сайта.
 */
class ProductsCatalog extends Chunk
{

    /**
     * Запускает работу ProductCatalog.
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
            'allowPrice' => $properties[0],
            'submitButton' => $properties[1],
            'multiOrder' => $properties[2],
            'oldPrice' => $properties[3],
            'withoutPrice' => $properties[4],
            'zeroBalance' => $properties[5],
            'userChoice' => $properties[6],
        ];
    }
}