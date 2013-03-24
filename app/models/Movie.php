<?php

class Movie
{
    const MOVIE_ID = "MovieID";
    const IMDB_ID = "ImdbID";
    const TITLE = "Title";
    const PLOT = "Plot";
    const RELEASED = "Released";
    const LANGUAGE = "Language";
    const RUNTIME = "Runtime";
    const PRODUCTION_COMPANY = "ProductionCompany";
    const DIRECTOR = "Director";
    const WRITER = "Writer";
    
    // Not database columns
    const ACTOR_LIST = "ActorList";
    const GENRE_LIST = "GenreList";
    
	public $id;
    public $imdb_id;
    public $tile;
    public $plot;
    public $released;
    public $language;
    public $runtime;
    public $production_company;
    public $director;
    public $writer;
    public $actors;
    public $genres;
    
    public function __construct(array $properties = null)
    {
        if (isset($properties))
        {
            $this->id = $properties[self::MOVIE_ID];
            $this->imdb_id = $properties[self::IMDB_ID];
            $this->title = $properties[self::TITLE];
            $this->plot = $properties[self::PLOT];
            $this->released = $properties[self::RELEASED];
            $this->language = $properties[self::LANGUAGE];
            $this->runtime = $properties[self::RUNTIME];
            $this->production_company = $properties[self::PRODUCTION_COMPANY];
            $this->director = $properties[self::DIRECTOR];
            $this->writer = $properties[self::WRITER];
            $this->actors = $properties[self::ACTOR_LIST];
            $this->genres = $properties[self::GENRE_LIST];
        }
    }
    
    public static function TableName()
    {
        return strtolower(get_class($this));
    }
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
