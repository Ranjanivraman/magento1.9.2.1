<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Prettylittlethingcom_Commercebug_Model_Crossareaajax_Togglecblogging extends Prettylittlethingcom_Commercebug_Model_Crossareaajax
{
    public function handleRequest()
    {
        $session = $this->_getSessionObject(); 
        $c = $session->getData(Prettylittlethingcom_Commercebug_Model_Observer::CB_LOGGING_ON);
        $c = $c == 'on' ? 'off' : 'on';        
        $session->setData(Prettylittlethingcom_Commercebug_Model_Observer::CB_LOGGING_ON,$c);
        $this->endWithHtml('Commerce Bug Logging ' . ucwords($c) .'');        
    }
}