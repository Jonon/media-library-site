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
    const TRAILER = "Trailer";
    const PRODUCTION_COMPANY = "ProductionCompany";
    const DIRECTOR = "Director";
    const WRITER = "Writer";
    
    // Not database columns
    const ACTOR_LIST = "ActorList";
    const GENRE_LIST = "GenreList";
    
	public $id;
    public $imdb_id;
    public $title;
    public $plot;
    public $released;
    public $language;
    public $runtime;
    public $trailer;
    public $production_company;
    public $director;
    public $writer;
    public $actors;
    public $genres;
    
    public $backdrops;
    public $logo;
    public $poster;
    
    public function __construct(array $properties = null)
    {
        if (isset($properties))
        {
            if (isset($properties[self::MOVIE_ID]))
                $this->id = $properties[self::MOVIE_ID];
            if (isset($properties[self::IMDB_ID]))
                $this->imdb_id = $properties[self::IMDB_ID];
            if (isset($properties[self::TITLE]))
                $this->title = $properties[self::TITLE];
            if (isset($properties[self::PLOT]))
                $this->plot = $properties[self::PLOT];
            if (isset($properties[self::RELEASED]))
                $this->released = $properties[self::RELEASED];
            if (isset($properties[self::LANGUAGE]))
                $this->language = $properties[self::LANGUAGE];
            if (isset($properties[self::RUNTIME]))
                $this->runtime = $properties[self::RUNTIME];
            if (isset($properties[self::TRAILER]))
                $this->trailer = $properties[self::TRAILER];                
            if (isset($properties[self::PRODUCTION_COMPANY]))
                $this->production_company = $properties[self::PRODUCTION_COMPANY];
            if (isset($properties[self::DIRECTOR]))
                $this->director = $properties[self::DIRECTOR];
            if (isset($properties[self::WRITER]))
                $this->writer = $properties[self::WRITER];
            if (isset($properties[self::ACTOR_LIST]))
                $this->actors = $properties[self::ACTOR_LIST];
            if (isset($properties[self::GENRE_LIST]))
                $this->genres = $properties[self::GENRE_LIST];
            
            if (isset($this->imdb_id)) {
                $this->logo = "img/logos/$this->imdb_id.png";
                $this->poster = "img/posters/$this->imdb_id.jpg";
                $this->backdrops = $this->getBackdrops();
            }
        }
    }
    
    public static function TableName()
    {
        return strtolower(get_class());
    }
    
    private function getBackdrops()
    {
        $images = array();
        $path = "img/backdrops/$this->imdb_id/";
        if (is_dir($path)) {
            $dir = new DirectoryIterator($path);
            foreach ($dir as $item) {
                if ($item->isFile()) {
                    $imageInfo = getimagesize($item->getPathname());
                    if ($imageInfo) {
                        $mime = $imageInfo[2];
                        if ($mime == IMAGETYPE_JPEG || $mime == IMAGETYPE_PNG) {
                            $images[] = $path . $item->getFileName();
                        }
                    }
                }
            }
        }
        return $images;
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
