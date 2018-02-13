<?php

namespace Urb\Procedure\Step;

use SplPriorityQueue;
use Urb\Procedure\Step\StepInterface;

class Steps extends SplPriorityQueue
{
    /**
     * Construct Priority Queue of Steps
     *
     * @param array $steps
     */
    public function __construct(array $steps)
    {
        $this->insertSteps($steps);
    }

    /**
     * Inserts an array of steps into the priority queue
     *
     * @param array $steps
     */
    public function insertSteps(array $steps)
    {
        foreach($steps as $step)
        {
            $this->insertStep($step);
        }
    }

    /**
     * Insert Step into Priority Queue
     * @param \Urb\Procedure\Step\StepInterface $step
     * @param null $priority - set/override an existing priority
     * @return $this
     */
    public function insertStep(StepInterface $step,$priority = null)
    {
        $this->insert($step,$this->getStepPriority($step,$priority));
        return $this;
    }

    /**
     * Gets passed step's priority
     *
     * @param \Urb\Procedure\Step\StepInterface $step
     * @param int|null $priority
     * @return int|null
     */
    protected function getStepPriority(StepInterface $step,$priority = null)
    {
        if(null === $priority && $step instanceof PriorityStepInterface)
        {
            return $step->getPriority();
        }

        return null === $priority ? 0 : (int)$priority;
    }

}