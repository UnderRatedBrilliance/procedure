<?php

namespace Urb\Procedure\Step;


use Exception;

class ConvertXmlToJson extends Step implements StepInterface
{
    protected $name = 'Convert Xml to Json';

    /**
     * Process the data passed
     *
     * @param mixed &$data
     * @return bool - a return value of false the items should be skipped
     * @throws Exception
     */
    public function process(&$data)
    {
        libxml_use_internal_errors(true);

        $xml = simplexml_load_string($data);

        if(!$xml)
        {
            libxml_clear_errors();
            throw $this->getException('Not valid XML');
        }

        return json_encode($xml);
    }

}