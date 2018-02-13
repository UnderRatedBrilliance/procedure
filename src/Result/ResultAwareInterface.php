<?php

namespace Urb\Procedure\Result;


interface ResultAwareInterface
{
    public function setResult(ResultInterface $result);

    /**
     * @return ResultInterface
     */
    public function getResult();
}