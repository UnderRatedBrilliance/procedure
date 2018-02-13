<?php

namespace Urb\Procedure\Step;


use Urb\Procedure\Data\DataInterface;

interface StepInterface
{
    /**
     * Process the data passed
     *
     * @param mixed &$data
     * @return boolean - a return value of false the items should be skipped
     */
    public function process(&$data);

    /**
     * Step must be callable
     *
     * @param mixed &$data
     * @return boolean
     */
    public function __invoke(&$data);

}