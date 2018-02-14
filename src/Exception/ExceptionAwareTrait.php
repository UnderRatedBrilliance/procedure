<?php

namespace Urb\Procedure\Exception;

use Exception;

trait ExceptionAwareTrait
{
    /**
     * @var array
     */
    protected $exceptions = [];

    /**
     * add Exception to ObjectStorage
     *
     * @param Exception $exception
     * @return $this
     */
    public function addExceptions(Exception $exception)
    {
        $this->exceptions[] = $exception;
    }

    /**
     * Returns an object storage of all exceptions captured
     *
     * @return array
     */
    public function getExceptions()
    {
        return $this->exceptions;
    }
}