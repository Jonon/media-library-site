<?php

class Genre
{
	public $genre_id;
    public $genre_name;
}

class GenreList
{
    private $_list;
    
    public function __construct()
    {
        $this->_list = array();
    }
    
    public function add(Genre $item) 
    {
        $this->_list[] ) $item;
    }
    
    public function get()
    {
        return $this->_list;
    }
}
