<?php

namespace App\Adapters\Chunks\ChunkToBlade;

class ActiveLogic extends Chunk
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
        // TODO: Implement fillJson() method.
    }

    /**
     * Формирует ассоциативный массив, не используется в классе.
     *
     * @param array $properties
     *
     * @return array
     */
    public function reformatProperties(array $properties): array
    {
        return [];
    }
}