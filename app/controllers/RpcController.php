<?php

require_once 'database/Database.php';
require_once 'controllers/MovieService.php';
require_once 'views/RpcView.php';

/**
 * Json Remote Procedure Call controller
 */
class RpcController
{
    private $_view;
    
    public function __construct() 
    {
        $this->_view = new RpcView();
    }

    /**
     * Handles page request and performs the approriate action based on input
     */
    public function handleRequest()
    {
        if (($serviceName = $this->_view->getService()) != false) {
            if ($this->_view->getMethod() != false)
            $serviceName .= 'Service';
            $service = new $serviceName();
            $service->handleRequest($this->_view->getMethod(), $this->_view->getParams());
        }
    } 
}
