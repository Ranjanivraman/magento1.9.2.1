<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Prettylittlethingcom_Commercebug_Model_Graphviz
{
    public function capture()
    {    
        $collector  = new Prettylittlethingcom_Commercebug_Model_Collectorgraphviz; 
        $o = new stdClass();
        $o->dot = Prettylittlethingcom_Commercebug_Model_Observer_Dot::renderGraph();
        $collector->collectInformation($o);
    }
    
    public function getShim()
    {
        $shim = Prettylittlethingcom_Commercebug_Model_Shim::getInstance();        
        return $shim;
    }    
}