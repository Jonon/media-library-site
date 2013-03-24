<?php

require_once 'database/ActorDAL.php';
require_once 'database/GenreDAL.php';
require_once 'database/MovieDAL.php';

/**
 * MovieService
 */
class MovieService
{
    private $_movieDal;
    
    public function __construct()
    {
        $this->_movieDal = new MovieDAL();
    }
    
    /**
     * Handles request and performs the approriate action based on input
     */
    public function handleRequest($method, $params)
    {
        call_user_func_array(array($this, $method), $params);
    }
    
    public function getAllMovies()
    {
        $movies = $this->_movieDal->getMovies();
        $json = json_encode($movies);
        
        // Set content
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
    }
    
    public function getMovieByImdbId($imdb_id)
    {
        $movie = $this->_movieDal->getMovieById($imdb_id);
        $json = json_encode($movie);
        
        // Set content
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
    }

}
