<?php

namespace Urb\Procedure\Step;


interface PriorityStepInterface extends StepInterface
{
    /**
     * @return integer
     */
    public function getPriority();
}