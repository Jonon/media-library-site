<?php

class Actor
{
    const ACTOR_ID = "ActorID";
    const IMDB_LINK = "ImdbLink";
    const NAME = "Name";
    
	public $actor_id;
    public $imdb_link;
    public $name;
    
    public function __construct(array $properties = null)
    {
        if (isset($properties))
        {
            $this->actor_id = $properties[self::ACTOR_ID];
            $this->imdb_link = $properties[self::IMDB_LINK];
            $this->name = $properties[self::NAME];
        }
    }
    
    public static function TableName()
    {
        return strtolower(get_class($this));
    }
}

class ActorList
{
    private $_list;
    
    public function __construct()
    {
        $this->_list = array();
    }
    
    public function add(Actor $item) 
    {
        $this->_list[] = $item;
    }
    
    public function get()
    {
        return $this->_list;
    }
}
