<?php
/**
 * HTTP错误异常
 */
namespace tank\Error;

use tank\Error\error;

class httpError extends \Exception
{
    public function __construct(string $message = "", \Throwable $previous = null)
    {
        error::create($message, __FILE__, __LINE__);
    }

}