<?php

class Genre
{
    const GENRE_ID = "GenreID";
    const GENRE = "Genre";
    
	public $genre_id;
    public $genre;
    
    public function __construct(array $properties = null)
    {
        if (isset($properties))
        {
            $this->genre_id = $properties[self::GENRE_ID];
            $this->genre = $properties[self::GENRE];
        }
    }
    
    public static function TableName()
    {
        return strtolower(get_class($this));
    }
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
        $this->_list[] = $item;
    }
    
    public function get()
    {
        return $this->_list;
    }
}
