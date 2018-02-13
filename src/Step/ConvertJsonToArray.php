<?php

namespace Urb\Procedure\Step;


use Exception;

class ConvertJsonToArray extends Step implements StepInterface
{
    protected $name = 'Convert Json to Array';

    /**
     * Process the data passed
     *
     * @param mixed &$data
     * @return bool - a return value of false the items should be skipped
     * @throws Exception
     */
    public function process(&$data)
    {
        $data = json_decode($data,true);

        $this->checkJsonErrors($data);

       return json_decode($data,true);
    }

    /**
     * Checks if any Json errors have occurred and throws exception
     *
     * @param $data
     * @throws Exception
     */
    protected function checkJsonErrors($data)
    {
        $jsonError = json_last_error();

        if(is_null($data) && $jsonError == JSON_ERROR_NONE) {
            throw $this->getException('Could not decode JSON');
        }

        if($jsonError != JSON_ERROR_NONE)
        {
            $error =  'Could not decode JSON - ';

            //Use a switch statement to figure out the exact error.
            switch($jsonError){
                case JSON_ERROR_DEPTH:
                    $error .= 'Maximum depth exceeded!';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $error .= 'Underflow or the modes mismatch!';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $error .= 'Unexpected control character found';
                    break;
                case JSON_ERROR_SYNTAX:
                    $error .= 'Malformed JSON';
                    break;
                case JSON_ERROR_UTF8:
                    $error .= 'Malformed UTF-8 characters found!';
                    break;
                default:
                    $error .= 'Unknown error!';
                    break;
            }
            throw $this->getException($error);
        }
    }

}