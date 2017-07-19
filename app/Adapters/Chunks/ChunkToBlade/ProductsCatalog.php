<?php

namespace App\Adapters\Chunks\ChunkToBlade;

/**
 * Адаптер для каталога товаров и панели заказов.
 */
class ProductsCatalog extends Chunk
{
    /**
     *  Адаптер для каталога товаров и панели заказов, который формирует json,
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
        // Разница между каталогом товаров и панелью заказов будет в шаблоне.
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