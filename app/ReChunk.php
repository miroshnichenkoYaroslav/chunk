<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReChunk extends Model
{
    /**
     * Название таблицы.
     *
     * @var string
     */
    protected $table = 'rechunks';

    /**
     * Разрешенные поля для записи.
     *
     * @var array
     */
    protected $fillable = ['id', 'site_id', 'type', 'body'];

    /**
     * Отключение стандартных полей created_at, updated_at.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Отключает инкремент для Primary Key в модели.
     *
     * @var bool
     */
    public $incrementing = false;
}
