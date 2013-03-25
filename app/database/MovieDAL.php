<?php

require_once 'models/Movie.php';
require_once 'database/ActorDAL.php';
require_once 'database/GenreDAL.php';

/**
 * MovieDAL
 */
class MovieDAL
{
    private $_db;
    
    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function get($movieId = null)
    {
        $sql = null;
        if (is_null($movieId))
            $sql = "SELECT " . Movie::MOVIE_ID . ", " . Movie::IMDB_ID . ", " . Movie::TITLE . " FROM " . Movie::TableName();
        else
            $sql = "SELECT * FROM " . Movie::TableName() . " WHERE " . Movie::MOVIE_ID . "=:movieId";
        $stmt = $this->_db->Prepare($sql);
        if (isset($movieId))
            $stmt->bindParam(":movieId", $movieId, PDO::PARAM_INT);
        $result = $this->_db->SelectQuery($stmt);
        $movies = isset($movieId) ? null : new MovieList();
        foreach ($result as $movie)
        {
            if (isset($movieId))
            {
                // Ugly hack, should be redesigned, database needs abstraction
                $actorDal = new ActorDAL();
                $genreDal = new GenreDAL();
                $movie[Movie::ACTOR_LIST] = $actorDal->get($movieId)->get();
                $movie[Movie::GENRE_LIST] = $genreDal->get($movieId)->get();
                $movies = new Movie($movie);
                break;
            }
            $movies->add(new Movie($movie));
        }
        return $movies;
    }
}
