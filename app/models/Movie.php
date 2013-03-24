<?php

class Movie
{
	public $id;
    public $imdb_id;
    public $tile;
    public $released;
    public $language;
    public $runtime;
    public $production_company;
    public $director;
    public $writer;
    public $actors;
    public $genres;
}

class MovieList
{
    private $_list;
    
    public function __construct()
    {
        $this->_list = array();
    }
    
    public function add(Movie $item) 
    {
        $this->_list[] = $item;
    }
    
    public function get()
    {
        return $this->_list;
    }
}
