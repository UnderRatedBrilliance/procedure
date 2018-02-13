<?php

namespace Urb\Procedure\Step;


use Exception;

abstract class Step implements StepInterface
{
    protected $name = 'Abstract Step';

    public function getName()
    {
        return $this->name;
    }

    /**
     * Step must be callable
     *
     * @param mixed &$data
     * @return boolean
     */
    public function __invoke(&$data)
    {
        return $this->process($data);
    }

    /**
     * Returns new Exception with step name appended in the status message
     *
     * @param $msg
     * @return Exception
     */
    protected function getException($msg)
    {
        return new Exception($this->getName().': '.$msg);
    }
}