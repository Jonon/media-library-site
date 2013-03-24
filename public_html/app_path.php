<?php

/**
 * Set different paths as APP_PATH and LIB_PATH and require this in index.php or other public files
 */
if (!defined("APP_PATH"))
{
	define("APP_PATH", realpath(dirname(__FILE__)) . "/../app", false);
}
if (!defined("LIB_PATH"))
{
	define("LIB_PATH", realpath(dirname(__FILE__)) . "/../lib", false);
}

set_include_path(get_include_path() . PATH_SEPARATOR . APP_PATH . PATH_SEPARATOR . LIB_PATH);
