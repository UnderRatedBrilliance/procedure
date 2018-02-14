<?php

namespace Urb\Procedure;

use DateTime;
use Exception;
use Urb\Procedure\Data\DataExceptionInterface;
use Urb\Procedure\Data\DataInterface;
use Urb\Procedure\Data\DataLoggerInterface;
use Urb\Procedure\Procedure\ProcedureInterface;
use Urb\Procedure\Result\ResultAwareInterface;
use Urb\Procedure\Step\Steps;
use Urb\Procedure\Step\StepInterface;


abstract class Procedure implements ProcedureInterface, StepInterface
{
    /**
     * Procedure Name
     *
     * @var string
     */
    protected $name = 'Abstract Procedure';

    /**
     * @var bool
     */
    protected $stopOnFailure = false;

    /**
     * @var \Urb\Procedure\Step\Steps
     */
    protected $steps;

    /**
     * @param Steps $steps
     */
    public function __construct(Steps $steps)
    {
        $this->steps = $steps;
    }


    /**
     * Add Step to current Queue
     *
     * fluent interface
     *
     * @param StepInterface $step
     * @return $this
     */
    public function addStep(StepInterface $step)
    {
        $this->steps->insertStep($step);
        return $this;
    }

    /**
     * Process data with each step in the priority queue
     *
     * @param array|mixed|\Urb\Procedure\Data\DataInterface $data
     * @return mixed
     */
    public function process(&$data)
    {
        /**
         * If data does not implement DataInterface then execute steps
         * on data.
         */
        if(!$data instanceof DataInterface)
        {
            return $this->executeSteps($data);
        }

        /**
         * Initialize Results
         */
        if($this->hasResult($data))
        {
            /** @var &$data ResultAwareInterface */
            $this->initResult($data);
        }

        /**
         * Iterate through each item from data set
         */
        foreach($data as $index => $item)
        {
            $data[$index] = $this->process($item);
        }

        /**
         * Finalize Results ex. Set EndTime and or add additional exceptions
         */
        if($this->hasResult($data))
        {
            /** @var &$data ResultAwareInterface */
            $this->finishResult($data);
        }

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     * @throws Exception
     */
    protected function executeSteps(&$data)
    {
        try {
            /**
             * Process item through each step in procedure
             */
            foreach(clone $this->steps as $step)
            {
                /**
                 * Process Data through step Exceptions will exit foreach
                 */
                $step->process($data);
            }


        } catch(Exception $e)
        {
            /** @todo implement $context */
            $this->handleException($data,$e/*,$context*/);
        }

        return $data;
    }
    /**
     * Handles any exceptions that are caught during procedure's process
     *
     * @param DataInterface $data
     * @param Exception $exception
     * @param array $context
     * @throws Exception
     */
    protected function handleException($data, Exception $exception, array $context = [])
    {
        //Stop execution and throw error if stopOnFailure === true
        if($this->stopOnFailure)
        {
            throw $exception;
        }

        //Add Exception to storage if implements DataExceptionInterface
        if($data instanceof DataExceptionInterface)
        {
            $data->addExceptions($exception);
        }

        //Add Exception to storage if implements DataLoggerInterface
        if($data instanceof DataLoggerInterface)
        {
            $data->error($exception->getMessage(),$context);
        }
    }

    /**
     * Get Procedure Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param \Urb\Procedure\Data\DataInterface $data
     * @return mixed
     */
    public function __invoke(&$data)
    {
        return $this->process($data);
    }

    /**
     * Data is Result Aware Object
     *
     * @param $data
     * @return bool
     */
    protected function hasResult($data)
    {
        return $data instanceof ResultAwareInterface;
    }

    /**
     * @param $data
     */
    protected function initResult(ResultAwareInterface &$data)
    {
        $data->setResult($data->getResult()
            ->setName($this->getName())
            ->setStartTime((new DateTime))
        );
    }

    /**
     * @param $data
     */
    protected function finishResult(ResultAwareInterface &$data)
    {
        $data->setResult($data->getResult()
            ->setEndTime((new DateTime))
        );
    }

}