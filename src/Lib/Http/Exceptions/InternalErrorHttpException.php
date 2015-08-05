<?php

namespace Vinnige\Lib\Http\Exceptions;

/**
 * Class InternalErrorHttpException
 * @package Vinnige\Lib\Http\Exceptions
 */
class InternalErrorHttpException extends HttpException
{
    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(500, $message, [], $code, $previous);
    }
}
