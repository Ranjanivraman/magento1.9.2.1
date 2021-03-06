<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/

class Prettylittlethingcom_Commercebug_Model_Collector extends Mage_Core_Helper_Abstract
{
    protected $controller;
    protected $layout;
    protected $request;
    
    protected $models = array();
    protected $blocks = array();

    protected $_singleCollectors=array();		
    public function registerSingleCollector(Prettylittlethingcom_Commercebug_Model_Observingcollector $object)
    {
        if(!in_array($object, $this->_singleCollectors))
        {
            $this->_singleCollectors[] = $object;
        }
        return $this;
    }		
            
    //renders as json.
    public function asJson()
    {
        $shim = $this->getShim();
        $json = new stdClass();
        
        foreach($this->_singleCollectors as $single_collector)
        {
            $json = $single_collector->addToObjectForJsonRender($json);	
        }

        $json = $shim->getSingleton('commercebug/jslabels')->addTableLabelsToJson($json);
        
        //add standard objects to surpress from other models tab
        $json->standardModels = preg_split('%\s%',$shim->getStoreConfig('commercebug/options/standard_classes'));        
        
        //add 404 tab content
        $json->status_404 = Mage::getSingleton('commercebug/404_lint')->asStdClass();
        
        //stateless nonce for graph render requests
        $json->nonce_cross_system = md5 (md5( date('Y-m-d') ) . 'not a drill');
        $json->layout->url_render_dot = 
            Mage::getStoreConfig('commercebug/options/url_render_dot');
            
        //'404 Tab';
        
        //add mage2 flag 
        $json->isMage2 = $shim->isMage2();
        $json = $shim->getSingleton('commercebug/jsonbroker')->jsonEncode($json); 
        
        
        
        $message = $shim->helper('commercebug/log')->format($json);
        $shim->helper('commercebug/log')->log($message);						
        return $json;			
    }
    
    private function getClassFile($className)
    {
        $r = new ReflectionClass($className);
        return $r->getFileName();		
    }
    
    function getShim()
    {
        $shim = Prettylittlethingcom_Commercebug_Model_Shim::getInstance();
        return $shim;		
    }		
}