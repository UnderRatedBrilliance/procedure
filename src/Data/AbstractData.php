<?php

namespace Urb\Procedure\Data;


use Urb\Procedure\Result\ResultAwareInterface;
use Urb\Procedure\Result\ResultAwareTrait;


abstract class AbstractData implements DataInterface, ResultAwareInterface
{
    use ResultAwareTrait;
}