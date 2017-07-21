<?php

namespace App\Adapters\Exceptions;

use InvalidArgumentException;
use Throwable;

class ChunkDoesNotExistException extends InvalidArgumentException
{
    /**
     * ChunkDoesNotExistException constructor.
     *
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct( $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Chunk does not exist.'),
            $code,
            $previous
        );
    }

}