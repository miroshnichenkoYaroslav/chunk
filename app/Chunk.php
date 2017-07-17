<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $id
 * @property int $type
 * @property int $site_id
 * @property int $body
 */
class Chunk extends Model
{
    /**
     * Таблица для работы с моделью.
     *
     * @var string
     */
    protected $table = 'chunk';

    /**
     * переменные для работы с чанками
     *
     * @var array
     */
    protected $fillable = [
        'id', 'site_id', 'type', 'body'
    ];
}
