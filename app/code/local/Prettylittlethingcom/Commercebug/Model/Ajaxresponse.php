<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/

class Prettylittlethingcom_Commercebug_Model_Ajaxresponse extends Varien_Object
{
    public function render()
    {
        header('Content-Type: application/json');
        echo $this->getShim()->getSingleton('commercebug/jsonbroker')->jsonEncode($this->getData());
    }
    
    function getShim()
    {
        $shim = Prettylittlethingcom_Commercebug_Model_Shim::getInstance();
        return $shim;		
    }		
    
}
