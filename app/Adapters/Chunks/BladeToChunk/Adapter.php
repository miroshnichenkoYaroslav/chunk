<?php

namespace App\Adapters\Chunks\BladeToChunk;

use App\Adapters\Exceptions\ChunkDoesNotExistException;
use App\Chunk;
use App\ReChunk;

/**
 * Адаптер выполняет поиск в новой базе чанка, адаптирует запись для старой базы.
 * Записывает адаптированные данные в старую базу.
 *
 * Class Adapter
 * @package App\Adapters\Chunks\BladeToChunk
 */
class Adapter
{
    /**
     * Данные о чанке.
     *
     * @var array
     */
    protected $config;

    /**
     * Запускает методы адаптера
     *
     * @param string $id
     *
     * @return void
     */
    public function run($id = null): void
    {
        if ($id === null) {
            throw new ChunkDoesNotExistException($id);
        }

        $this->reformat($this->find($id));
        $this->save();
    }

    /**
     * Находит в базе конкретный чанк по идентификатору.
     *
     * @param string $id
     *
     * @return ReChunk
     */
    public function find($id): ReChunk
    {
        return ReChunk::findOrFail($id);
    }

    /**
     * Подготавливает данные под старую базу.
     *
     * @param ReChunk $chunk
     *
     * @return void
     */
    public function reformat($chunk): void
    {
        $this->config = $chunk->toArray();
        $this->config['body'] = $this->toString($chunk->body);
    }

    /**
     * Преобразует json массив параметров чанков в строку.
     *
     * @param $options
     *
     * @return string
     */
    public function toString($options): string
    {
        $options = json_decode($options, true);
        $options['properties'] = $this->translate($options['properties']);

        // Возвращаем в массив неиспользуемые параметры
        array_splice($options, 7, 0, 0);
        array_splice($options, 14, 0, [0,0,0]);

        return implode("\r\n", $options);
    }

    /**
     * Преобразуем массив флагов в число.
     *
     * @param array $properties
     *
     * @return int
     */
    public function translate($properties): int
    {
        $properties = implode(array_reverse($properties));

        return base_convert($properties, 2, 10);
    }

    /**
     * Сохраняем адаптированный чанк в базу данных.
     *
     * @return void
     */
    public function save(): void
    {
        if (Chunk::find($this->config['id'])){
            Chunk::where('id', $this->config['id'])->update($this->config);
        } else {
            Chunk::create($this->config);
        }
    }
}