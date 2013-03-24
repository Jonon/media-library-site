<?php

class RpcView
{
    private $_service = "service";
    private $_method = "method";
    private $_params = "params";
    
    public function getService()
    {
        if (isset($_POST[$this->_service]))
            if (!empty($_POST[$this->_service])
                return $_POST[$this->_service];
        return false;
    }
    
    public function getMethod()
    {
        if (isset($_POST[$this->_method]))
            if (!empty($_POST[$this->_method])
                return $_POST[$this->_method];
        return false;
    }
    
    public function getParams()
    {
        if (isset($_POST[$this->_params]))
            return $_POST[$this->_params];
        return false;
    }
}