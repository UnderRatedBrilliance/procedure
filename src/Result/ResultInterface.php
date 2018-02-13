<?php

namespace Urb\Procedure\Result;

use DateTime;
use Exception;

interface ResultInterface
{
    /**
     * Get Procedure Name
     *
     * @return string
     */
    public function getName();

    /**
     * Get Procedure Start Time
     *
     * @return \DateTime
     */
    public function getStartTime();

    /**
     * Get Procedure End Time
     *
     * @return \DateTime
     */
    public function getEndTime();

    /**
     * Get Procedure Elapse Time
     *
     * @return bool|\DateInterval
     */
    public function getElapsed();

    /**
     * Get Procedure error count
     *
     * @return int
     */
    public function getErrorCount();

    /**
     *  Get Procedure Success Count
     *
     * @return int
     */
    public function getSuccessCount();

    /**
     * Get procedure total processed count
     *
     * @return int
     */
    public function getTotalProcessCount();

    /**
     * Check for procedure errors
     *
     * @return bool
     */
    public function hasErrors();

    /**
     * Get procedure's exceptions
     *
     * @return \SplObjectStorage
     */
    public function getExceptions();

    /**
     * Add Exception to result object
     *
     * @param Exception $exception
     * @param $context
     * @return $this
     */
    public function addException(Exception $exception,$context);

    /**
     *  Set Start Time
     *
     * @param DateTime $time
     * @return $this
     */
    public function setStartTime(DateTime $time);

    /**
     *  Set End Time
     *
     * @param DateTime $time
     * @return $this
     */
    public function setEndTime(DateTime $time);

    /**
     * Increment Success Count
     *
     * @return $this
     */
    public function incrementSuccessCount();

    /**
     * Set Result Name
     *
     * @param $name
     * @return $this
     */
    public function setName($name);
}