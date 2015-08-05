<?php

namespace Vinnige\Lib\Http\Exceptions;

/**
 * Class ConflictHttpException
 * @package Vinnige\Lib\Http\Exceptions
 */
class ConflictHttpException extends HttpException
{
    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(409, $message, [], $code, $previous);
    }
}
