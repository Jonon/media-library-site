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
        $movieList = $this->_movieDal->get();
        $this->printJsonResult($movieList->get());
    }
    
    public function getMovieById($id)
    {
        if (isset($id)) {
            $movie = $this->_movieDal->get($id);
            $this->printJsonResult($movie);
        }
    }
    
    private function printJsonResult($data)
    {
        $json = json_encode($data, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // Set content
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
    }

}
