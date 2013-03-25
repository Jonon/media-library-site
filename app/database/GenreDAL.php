<?php

require_once 'models/Genre.php';

/**
 * GenreDAL
 */
class GenreDAL
{
    private $_db;
    
    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function get($movieId)
    {
        $sql = "SELECT g.GenreID, g.Genre FROM genre as g " . 
        "LEFT JOIN moviegenre as mg " .
        "ON g.GenreID = mg.GenreID " .
        "LEFT JOIN movie as m " .
        "ON m.MovieID = mg.MovieID " .
        "WHERE m.MovieID = :movieId";
        $stmt = $this->_db->Prepare($sql);
        $stmt->bindParam(":movieId", $movieId, PDO::PARAM_INT);
        $result = $this->_db->SelectQuery($stmt);
        $genres = new GenreList();
        foreach ($result as $genre)
        {
            $genres->add(new Genre($genre));
        }
        return $genres;
    }
}
