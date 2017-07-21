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
     * Отлкючена работа со временем в таблице.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * // TODO
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * переменные для работы с чанками
     *
     * @var array
     */
    protected $fillable = [
        'id', 'site_id', 'type', 'body'
    ];
}
