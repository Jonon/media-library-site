<?php

require_once 'models/Actor.php';

/**
 * ActorDAL
 */
class ActorDAL
{
    private $_db;
    
    public function __construct(Database $database)
    {
        $this->_db = Database::getInstance();
    }

    public function Get($movieId)
    {
        $sql = "SELECT a.ActorID, a.ImdbLink, a.Name FROM actor as a " . 
        "LEFT JOIN movieactor as ma " .
        "ON a.ActorID = ma.ActorID " .
        "LEFT JOIN movie as m " .
        "ON m.MovieID = ma.MovieID " .
        "WHERE m.MovieID = :movieId";

        $stmt = $this->_db->Prepare($sql);
        $stmt->bindParam(":movieId", $movieId, PDO::PARAM_INT);
        $result = $this->_db->SelectQuery($stmt);
        
        $actors = array();
        
        foreach ($result as $actor)
        {
            $actors[] = new Actor($actor);
        }
        return $actors;
    }
}
