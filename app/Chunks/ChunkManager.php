<?php

namespace App\Chunks;

class ChunkManager
{
    /**
     * Хранилище настроек чанков.
     *
     * @var array
     */
    protected $container;

    /**
     * Добавляем пользовательский настройки чанка а контейнер.
     *
     * @param $settings string
     *
     * @return void
     * @throws \Exception
     */
    public function add(string $settings): void
    {
        if (!empty($settings)) {
            $this->container[] = $settings;
        } else {
            throw new \Exception('Не переданы параметры чанка');
        }
    }

    /**
     * Отображение чанка(ов).
     *
     * @param $settings string
     *
     * @return string
     */
    public function show(string $settings): string
    {
        $settings = explode(',', $settings); // [0 => 'user:form:top', 1...]
        $chunks = ''; // Не отображаем ничего

        foreach ($settings as $setting) {
            if (in_array($setting, $this->container)) {
                $name = explode(':', $setting)[1];
                $chunks .= $this->create($name);
            } else {
                continue;
            }
        }

        return $chunks;
    }

    /**
     * Получаем содержимое чанка.
     *
     * @param $name string
     *
     * @return string
     * @throws \Exception
     */
    private function create(string $name): string
    {

        if (array_key_exists($name, $this->map())) {
            $class = $this->map()[$name];

            /** @var Chunk $chunk */
            $chunk = new $class;

            return $chunk->make($name);
        } else {
            throw new \Exception('Не существующий тип чанка');
        }
    }

    /**
     * Получаем все типы чанков.
     *
     * @return array
     */
    private function map(): array
    {
        return [
            'login' => Login::class,
            'link' => Link::class,
            'form' => Form::class,
            'text' => Text::class
        ];
    }

    /**
     * Для теста, получаем контейнер.
     *
     * @return array
     */
    public function get()
    {
        return $this->container;
    }
}