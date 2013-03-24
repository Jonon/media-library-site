<?php

require_once 'configs/DbConfig.php';

class Database
{
    private static $instance;
    
    public static function getInstance()
    {
        return isset(self::$instance) ? self::$instance : self::$instance = new Database();
    }
    
    private $_config;
    private $_pdo;
    
    private function __construct()
    {
        try 
        {
            $dbconfig = new DbConfig();
            $this->connect();
        }
        catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }
    }
    
    public function connect()
    {
        try 
        {
            if (is_object($this->_config) && ($this->_config instanceof DBConfig))
            {
                $this->_pdo = new PDO(
                    "mysql:host=" . $this->_config->getHostname() . ";dbname=" . $this->_config->getDatabase() . ";", 
                    $this->_config->getUsername(), 
                    $this->_config->getPassword()
                );
            }
            else 
            {
                throw new Exception('No valid configuration found');
            }
            
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception)
        {
            throw $exception;
        }
    }
    
    public function disconnect()
    {
        $this->_pdo = null;
    }
    
    public function setConfig(DBConfig $config)
    {
        $this->_config = $config; 
    }
    
    public function prepare($sql)
    {
        $stmt = $this->_pdo->prepare($sql);
        if ($stmt == false)
            throw new Exception($this->_pdo->errorInfo());
        return $stmt;
    }
    
    public function selectQuery(PDOStatement $stmt)
    {
        try 
        {
            if (!$stmt->execute())
            {
                return false;
            }
        }
        catch (PDOException $exception)
        {
            throw $exception;
        }
        return $stmt->fetchAll();
    }
    
    public function createDeleteOrUpdateQuery(PDOStatement $stmt)
    {
        try 
        {
            if (!$stmt->execute())
            {
                return false;
            }
        }
        catch (PDOException $exception)
        {
            throw $exception;
        }
        return true;
    }
    
    public function lastInsertID($name = null)
    {
        return isset($name) ? $this->_pdo->lastInsertId($name) : $this->_pdo->lastInsertId();
    }
}
