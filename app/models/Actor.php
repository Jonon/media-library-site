<?php

class Actor
{
	public $id;
    public $imdb_link;
    public $name;
}

class ActorList
{
    private $_list;
    
    public function __construct()
    {
        $this->_list = array();
    }
    
    public function add(Actor $item) 
    {
        $this->_list[] ) $item;
    }
    
    public function get()
    {
        return $this->_list;
    }
}
