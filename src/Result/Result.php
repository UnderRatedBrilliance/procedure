<?php

namespace Urb\Procedure\Result;

use DateTime;
use SplObjectStorage;
use Exception;

class Result implements ResultInterface
{
    /**
     * Identifies the results set for a given procedure
     *
     * @var string
     */
    protected $name;

    /**
     * Procedure Start Time
     *
     * @var \DateTime
     */
    protected $startTime;

    /**
     *  Procedure End Time
     *
     * @var \DateTime
     */
    protected $endTime;

    /**
     * Error Count for procedure
     *
     * @var int
     */
    protected $errorCount = 0;

    /**
     * Success Count for procedure
     * @var int
     */
    protected $successCount = 0;

    /**
     * Total Processed Count for Procedure
     *
     * @var int
     */
    protected $totalProcessCount = 0;

    /**
     * Store Exceptions
     * @var \SplObjectStorage
     */
    protected $exceptions;

    /**
     * @param string $name
     * @param \DateTime $startTime
     * @param \DateTime $endTime
     * @param integer $totalCount
     * @param \SplObjectStorage $exceptions
     */
    public function __construct($name, DateTime $startTime, DateTime $endTime, $totalCount, SplObjectStorage $exceptions )
    {
        $this->name = (string) $name;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->totalProcessCount = $totalCount;
        $this->errorCount = count($exceptions);
        $this->successCount = $totalCount - $this->errorCount;
        $this->exceptions = $exceptions;
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
     * Get Procedure Start Time
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Get Procedure End Time
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Get Procedure Elapse Time
     *
     * @return bool|\DateInterval
     */
    public function getElapsed()
    {
        return $this->getStartTime()->diff($this->getEndTime());
    }

    /**
     * Get Procedure error count
     *
     * @return int
     */
    public function getErrorCount()
    {
        return count($this->exceptions);
    }

    /**
     *  Get Procedure Sucess Count
     * @return int
     */
    public function getSuccessCount()
    {
        return $this->successCount;
    }

    /**
     * Get procedure total processed count
     *
     * @return int
     */
    public function getTotalProcessCount()
    {
        return $this->totalProcessCount;
    }

    /**
     * Check for procedure errors
     *
     * @return bool
     */
    public function hasErrors()
    {
        return $this->errorCount > 0;
    }

    /**
     * Get procedure's exceptions
     *
     * @return \SplObjectStorage
     */
    public function getExceptions()
    {
        return $this->exceptions;
    }

    /**
     * @param Exception $exception
     * @param $context
     * @return $this
     */
    public function addException(Exception $exception,$context)
    {
        $this->exceptions->attach($exception,$context);
        return $this;
    }

    /**
     * @param DateTime $time
     * @return $this
     */
    public function setStartTime(DateTime $time)
    {
        $this->startTime = $time;
        return $this;
    }

    /**
     * @param DateTime $time
     * @return $this
     */
    public function setEndTime(DateTime $time)
    {
        $this->endTime = $time;
        return $this;
    }

    /**
     * Increment Success Count
     *
     * @return $this
     */
    public function incrementSuccessCount()
    {
        $this->successCount++;
        return $this;
    }

    /**
     * Set Result Name
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }
}