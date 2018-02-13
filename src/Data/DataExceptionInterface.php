<?php

namespace Urb\Procedure\Data;

use Exception;

interface DataExceptionInterface
{
    /**
     * add Exception to ObjectStorage
     *
     * @param Exception $exception
     * @param $data
     * @return $this
     */
    public function addExceptions(Exception $exception, $data);

    /**
     * Returns an object storage of all exceptions captured
     *
     * @return \SplObjectStorage
     */
    public function getExceptions();
}