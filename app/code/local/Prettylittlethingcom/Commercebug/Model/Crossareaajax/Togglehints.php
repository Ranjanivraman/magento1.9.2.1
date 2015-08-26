<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Prettylittlethingcom_Commercebug_Model_Crossareaajax_Togglehints extends Prettylittlethingcom_Commercebug_Model_Crossareaajax
{
    public function handleRequest()
    {
        $session = $this->_getSessionObject();
        $c = $session->getData(Prettylittlethingcom_Commercebug_Model_Observer::TEMPLATE_HINTS_ON);
        $c = $c == 'on' ? 'off' : 'on';        
        $session->setData(Prettylittlethingcom_Commercebug_Model_Observer::TEMPLATE_HINTS_ON,$c);
        $this->endWithHtml('Template Hints ' . ucwords($c) .' -- Refresh to see Changes.');
    }    
}