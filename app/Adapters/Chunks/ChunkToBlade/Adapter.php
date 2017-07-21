<?php

namespace App\Adapters\Chunks\ChunkToBlade;

use App\Adapters\Exceptions\ChunkDoesNotExistException;
use App\Adapters\Exceptions\ChunkTypeDoesNotExistException;
use App\Chunk;

/**
 * Класс Adapter, получает данные, и передает адаптер,
 * в зависимости от типа чанка(умного элемента).
 */
class Adapter
{
    /**
     * Массив параметров настроек чанка.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Запускает работу Adapter.
     *
     * @param string $id
     *
     * @return void
     */
    public function run($id = null): void
    {
        if ($id === null) {
            throw new ChunkDoesNotExistException();
        }

        $this->handleType($this->find($id));
    }

    /**
     * Получение данных с БД о конкретной странице.
     *
     * @param $chunk
     *
     * @return Chunk возвращает модель объекта.
     */
    public function find($chunk): Chunk
    {
        return Chunk::findOrFail($chunk);
    }

    /**
     * Определяет тип элемента, если не чанк возвращает столбец `body`
     * из бд, в котором html, если чанк - возвращает сформированный массив.
     *
     * @param $chunk - объект.
     *
     * @return array|string // TODO пока не до конца ясна структура
     */
    public function handleType(Chunk $chunk)
    {
        $type = $chunk->type;

        if ($type === 0) {

             dd('TODO записать в бд или файлик');

        } elseif ($type === 1) {

            $this->config = $chunk->toArray();

            $this->fillConfigs($chunk->body);

            $this->transfer();

        } elseif ($type === 2) {

            //TODO для типа 2.

        } elseif ($type === 3) {

            //TODO для типа 3.
        }

    }

    /**
     * Разбиваем строку по '\r\n' формируя массив,
     * данные которого записывает в контейнер.
     *
     * @param string $body
     *
     * @return void
     */
    public function fillConfigs(string $body): void
    {
        $this->config['body'] = [];

        $token = strtok($body, "\r\n");

        for ($i = 0; $token != ''; $i++) {
            $this->config['body'][] = $token;

            $token = strtok("\r\n");
        }

        $this->reformatConfigs();
    }

    /**
     * Передает параметры чанков в конкретный адаптер,
     * в зависимости от типа чанка.
     *
     * @return void
     */
    public function transfer(): void
    {
        $type = $this->config['body']['type'];

        if ($type === '0' || $type === '1') {

            $link = new Link;
            $this->config['body'] = $link->run($this->config['body']);

        } elseif ($type === '3') {

            $content = new PageContents;
            $this->config['body'] = $content->run($this->config['body']);

        } elseif ($type === '4') {

            $map = new Sitemap;
            $this->config['body'] = $map->run($this->config['body']);

        } elseif ($type === '5') {

            //TODO записать в бд $this->container['file'] - имя скрипта.

        } elseif ($type === '6' || $type === '7') {

            $catalog = new ProductsCatalog;
            $this->config['body'] = $catalog->run($this->config['body']);

        } elseif ($type === '8' || $type === '-1') {
            //TODO userLink
        } else {
            throw new ChunkTypeDoesNotExistException($type);
        }
    }

    /**
     * Формирует ассоциативный массив $options, и перезаписывает контейнер.
     *
     * @return void
     */
    public function reformatConfigs(): void
    {
        $this->config['body'] = [
            'pageId' => $this->config['body'][0],
            'type' => $this->config['body'][1],
            'properties' => $this->config['body'][2],
            'nested' => $this->config['body'][3],
            'allLevelsDown' => $this->config['body'][4],
            'rowsLimit' => $this->config['body'][5],
            'order' => $this->config['body'][6],
            'dateFromCheck' => $this->config['body'][8],
            'dateToCheck' => $this->config['body'][9],
            'dateFrom' => $this->config['body'][10],
            'dateTo' => $this->config['body'][11],
            'pagination' => $this->config['body'][12],
            'rowsPerPage' => $this->config['body'][13],
            'category' => $this->config['body'][17],
            'linkType' => $this->config['body'][18],
            'nameLink' => $this->config['body'][19] ?? false,
            'iconWidth' => $this->config['body'][20] ?? false,
            'iconHeight' => $this->config['body'][21] ?? false,
            'listPages' => $this->config['body'][22] ?? false,
            'file' => $this->config['body'][23] ?? false,
        ];
    }

    /**
     * Геттер для контейнера параметров, нужен для теста.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}
