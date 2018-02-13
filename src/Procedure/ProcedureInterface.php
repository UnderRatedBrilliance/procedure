<?php

namespace Urb\Procedure\Procedure;

use Urb\Procedure\Data\DataInterface;
use Urb\Procedure\Step\StepInterface;

interface ProcedureInterface
{
    /**
     * Adds step to the current procedure
     *
     * @param StepInterface $step
     * @return mixed
     */
    public function addStep(StepInterface $step);

    /**
     * Process data through all of the procedures steps
     *
     * @param $data
     * @return mixed
     */
    public function process(&$data);

    /**
     * Makes object callable by invoking the process method
     *
     * @param $data
     * @return mixed
     */
    public function __invoke(&$data);

}