<?php

namespace App\Adapters\Exceptions;

use InvalidArgumentException;
use Throwable;

class ChunkIdDoesNotExistException extends InvalidArgumentException
{
    /**
     * ChunkIdDoesNotExistException constructor.
     *
     * @param string $id
     * @param int $code
     * @param Throwable|null $previous
     * @internal param string $message
     */
    public function __construct(string $id, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Chunk with such an id = "%s" does not exist.', $id),
            $code,
            $previous
        );
    }

}