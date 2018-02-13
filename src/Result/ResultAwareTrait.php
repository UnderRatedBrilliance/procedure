<?php

namespace Urb\Procedure\Result;


trait ResultAwareTrait
{
    /**
     * @var \Urb\Procedure\Result\ResultInterface
     */
    protected $result;

    /**
     * Set Result Object
     * @param \Urb\Procedure\Result\ResultInterface $result
     */
    public function setResult(ResultInterface $result)
    {
        $this->result = $result;
    }

    /**
     * Return result object
     *
     * @return ResultInterface
     */
    public function getResult()
    {
        return $this->result;
    }
}