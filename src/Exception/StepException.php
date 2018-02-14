<?php

namespace Urb\Procedure\Exception;

use Exception;
use Throwable;

class StepException extends Exception
{
    protected $context;

    public function __construct($message = "",$context, $code = 0, Throwable $previous = null)
    {
        $this->context = $context;
        parent::__construct($message, $code, $previous);
    }

    public function getContext()
    {
        return $this->context;
    }

    public function __toString()
    {

        return parent::__toString().print_r($this->context,true);
    }
}