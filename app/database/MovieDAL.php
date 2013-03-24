<?php

require_once 'models/Movie.php';

/**
 * MovieDAL
 */
class MovieDAL
{
    private $_db;
    
    public function __construct(Database $database)
    {
        $this->_db = Database::getInstance();
    }

    public function Get($movieId = null)
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
        
        $movies = isset($movieId) ? null : array();
        
        foreach ($result as $movie)
        {
            if (isset($movieId))
            {
                $actorDal = new ActorDAL();
                $genreDal = new GenreDAL();
                
                $movie[Movie::ACTOR_LIST] = $actorDal->get($movieId);
                $movie[Movie::GENRE_LIST] = $genreDal->get($movieId);
                
                $movies = new Movie($movie);
                break;
            }
            $movies[] = new Movie($movie);
        }
        return $movies;
    }
}
