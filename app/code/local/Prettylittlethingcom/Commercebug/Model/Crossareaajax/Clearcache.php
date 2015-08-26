<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Prettylittlethingcom_Commercebug_Model_Crossareaajax_Clearcache extends Prettylittlethingcom_Commercebug_Model_Crossareaajax
{
    public function handleRequest()
    {
        $shim = $this->getShim();
        $shim->helper('commercebug/cacheclearer')->clearCache();
        $this->endWithHtml('Cache Cleared');    
    }
}