<?php

/**
 * Session
 */
class AppSession
{
	private static $instance;
	
    private $_csrf_token = 'csrf-token';
	private $_user = 'user';
	private $_role = 'role';
	private $_authenticated = 'authenticated';
	
    /**
     * Get the AppSession object instance
     * 
     * @return AppSession
     */
	public static function getInstance()
	{
		return self::$instance ? self::$instance : self::$instance = new AppSession(); 
	}
	
    /**
     * Starts a session
     */
	public function start()
	{
		session_start();
	}
    
    /**
     * Destroys a session
     */
    public function destroy()
    {
        session_destroy();
    }
	
    /**
     * Initialize a user
     * 
     * @param $user The user
     * @param $user Role of the user
     */
	public function initialize($user, $role)
	{
		$_SESSION[$this->_authenticated] = true;
		$_SESSION[$this->_user] = $user;
		$_SESSION[$this->_role] = $role;
	}
	
    /**
     * Check if user is authenticated
     * 
     * @return Boolean
     */
	public function isAuthenticated()
	{
		return isset($_SESSION[$this->_authenticated]) ? $_SESSION[$this->_authenticated] : false;
	}
	
    /**
     * Get the initialized user
     * 
     * @return String
     */
	public function getUser()
	{
		return isset($_SESSION[$this->_user]) ? $_SESSION[$this->_user] : false;
	}
	
    /**
     * Get the role of the initialized user
     * 
     * @return String
     */
	public function getRole()
	{
		return isset($_SESSION[$this->_role]) ? $_SESSION[$this->_role] : false;
	}
	
	public function getCsrfToken()
    {
        if (!isset($_SESSION[$this->_csrf_token])) {
            $_SESSION[$this->_csrf_token] = md5(uniqid(rand(), true));   
        }
        return $_SESSION[$this->_csrf_token];
    }
}
