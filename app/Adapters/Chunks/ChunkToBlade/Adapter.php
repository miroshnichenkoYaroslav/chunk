<?php

namespace App\Adapters\Chunks;

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
     * Adapter constructor.
     * Переданные данные передаются в метод dataProcessing.
     *
     * @param string $chunk
     */
    public function __construct($chunk = null)
    {
        if ($chunk === null) {
            throw new InvalidArgumentException('Переданны неверные данные.');
        }

        $this->dataProcessing($this->retrievePageData($chunk));
    }

    /**
     * Получение данных с БД о конкретной странице.
     *
     * @param $page
     *
     * @return Chunk возвращает модель объекта.
     */
    public function retrievePageData($page): Chunk
    {
        return Chunk::findOrFail($page);
    }

    /**
     * Определяет тип элемента, если не чанк возвращает столбец `body` из бд,
     * в котором html, если чанк - возвращает сформированный массив.
     *
     * @param $dataPage
     *
     * @return array|string
     */
    public function dataProcessing($dataPage)
    {
        $type = $dataPage->type;

        if ($type === 1) {
            $this->fillContainer($dataPage->body);

            $this->transferToTheAdapter();

        } elseif ($type === 0) {
            return $dataPage->body;

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
        if ($this->container['type'] === '0') {

            $adapter = new Link();
            $adapter->fillJson($this->container);

        } elseif ($this->container['type'] === '1') {

            $adapter = new Link();
            $adapter->fillJson($this->container);

        } elseif ($this->container['type'] === '2') {
            PageContents::fillJson($this->container);

        } elseif ($this->container['type'] === '3') {
            //NormalLink::fillJson($this->container);

        } elseif ($this->container['type'] === '4') {
            //NormalLink::fillJson($this->container);

        } elseif ($this->container['type'] === '5') {
            //NormalLink::fillJson($this->container);

        } elseif ($this->container['type'] === '6') {


        } elseif ($this->container['type'] === '7') {

        } elseif ($this->container['type'] === '8') {

        } else {
            //TODO userLink => $type = -1
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

}