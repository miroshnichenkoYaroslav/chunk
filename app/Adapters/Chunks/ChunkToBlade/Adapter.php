<?php

namespace App\Adapters\Chunks\ChunkToBlade;

use App\Chunk;
use Psr\Log\InvalidArgumentException;

/**
 * Класс Adapter, получает данные, и передает адаптер,
 * в зависимости от типа чанка(умного элемента).
 */
class Adapter
{
    /**
     * Массив параметров настройки чанка.
     *
     * @var array
     */
    protected $container = [];

    /**
     * Получает id чанка(умного элемента), инициализирует чанк по id.
     *
     * @param string $chunk - id chunk
     *
     * @return void
     */
    public function init($chunk = null): void
    {
        if ($chunk === null) {
            throw new InvalidArgumentException('Переданны неверные данные.');
        }

        $this->dataProcessing($this->retrieveChunkData($chunk));
    }

    /**
     * Получение данных с БД о конкретной странице.
     *
     * @param $chunk
     *
     * @return Chunk возвращает модель объекта.
     */
    public function retrieveChunkData($chunk): Chunk
    {
        return Chunk::findOrFail($chunk);
    }

    /**
     * Определяет тип элемента, если не чанк возвращает столбец `body`
     * из бд, в котором html, если чанк - возвращает сформированный массив.
     *
     * @param $chunk - объект.
     *
     * @return array|string
     */
    public function dataProcessing($chunk)
    {
        $type = $chunk->type;

        if ($type === 0) {

             //TODO записать в бд или файлик.

        } elseif ($type === 1) {

            $this->fillContainer($chunk->body);
            $this->transferToTheAdapter();

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
    public function fillContainer($body): void
    {
        $token = strtok($body, "\r\n");

        for ($i = 0; $token != ''; $i++) {
            $this->container[$i] = $token;

            $token = strtok("\r\n");
        }
    }

    /**
     * Передает параметры чанков в конкретный адаптер,
     * в зависимости от типа чанка.
     *
     * @return void
     */
    public function transferToTheAdapter(): void
    {
        $this->reformatContainer();

        $type = $this->container['type'];
        if ($type === '0' || $type === '1') {

            $link = new Link();
            $link->fillJson($this->container);

        } elseif ($type === '3') {

            $content = new PageContents();
            $content->fillJson($this->container);

        } elseif ($type === '4') {

            $map = new Sitemap();
            $map->fillJson($this->container);

        } elseif ($type === '5') {

            //TODO записать в бд $this->container['file'] - имя скрипта.

        } elseif ($type === '6' || $type === '7') {

            $catalog = new ProductsCatalog();
            $catalog->fillJson($this->container);

        } elseif ($type === '8' || $type === '-1') {
            //TODO userLink
        } else {
            throw new InvalidArgumentException('Получен неверный тип чанка.');
        }
    }

    /**
     * Формирует ассоциативный массив $options, и перезаписывает контейнер.
     *
     * @return void
     */
    public function reformatContainer(): void
    {
        $this->container = [
            'pageId' => $this->container[0],
            'type' => $this->container[1],
            'properties' => $this->container[2],
            'nested' => $this->container[3],
            'allLevelsDown' => $this->container[4],
            'rowsLimit' => $this->container[5],
            'order' => $this->container[6],
            'dateFromCheck' => $this->container[8],
            'dateToCheck' => $this->container[9],
            'dateFrom' => $this->container[10],
            'dateTo' => $this->container[11],
            'pagination' => $this->container[12],
            'rowsPerPage' => $this->container[13],
            'category' => $this->container[17],
            'linkType' => $this->container[18],
            'nameLink' => $this->container[19] ?? false,
            'iconWidth' => $this->container[20] ?? false,
            'iconHeight' => $this->container[21] ?? false,
            'listPages' => $this->container[22] ?? false,
            'file' => $this->container[23] ?? false,
        ];
    }

    /**
     * Геттер для контейнера, нужен для теста.
     *
     * @return array
     */
    public function getContainer(): array
    {
        return $this->container;
    }


}