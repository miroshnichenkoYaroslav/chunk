<?php

namespace App\Adapters\Exceptions;

use InvalidArgumentException;
use Throwable;

class ChunkTypeDoesNotExistException extends InvalidArgumentException
{
    /**
     * ChunkTypeDoesNotExistException constructor.
     *
     * @param int $type
     * @param int $code
     * @param Throwable|null $previous
     * @internal param string $message
     */
    public function __construct(int $type, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Chunk with such a type = "%s" does not exist.', $type),
            $code,
            $previous
        );
    }

}