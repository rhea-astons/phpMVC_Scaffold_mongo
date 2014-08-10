<?php
/**
 * Main class of PHP MVC App
 *
 * @package    phpMVC_Scaffold_mongo
 * @author     Raphael Santos <raph.snts@gmail.com>
 * @copyright  2014 Raphael Santos
 * @license    http://opensource.org/licenses/MIT 	The MIT License (MIT)
 * @link       http://github.com/raphsnts/phpMVC_Scaffold_mongo
 */
class Application
{
	private $_classRef = null;
	private $_controller = null;
	private $_action = null;
	private $_param1 = null;
	private $_param2 = null;
	private $_param3 = null;


	/**
	 * Constructor
	 */
	function __construct() {
		$this->setReporting();
		$this->removeMagicQuotes();
		$this->unregisterGlobals();
		$this->parseURL();

		// set controller name
		$this->_controller = ucwords($this->_classRef) . 'Ctrl';

		// If requested controller and method exists call them with given parameters,
		// otherwhise, call index method of existing controller,
		// or call index of default controller
		if (class_exists($this->_controller) && method_exists($this->_controller, $this->_action)) {
			$this->_controller = new $this->_controller($this->_classRef, $this->_action);
			if (isset($this->_param3)) {
				$this->_controller->{$this->_action}($this->_param1, $this->_param2, $this->_param3);
			} elseif (isset($this->_para2)) {
				$this->_controller->{$this->_action}($this->_param1, $this->_param2);
			} elseif (isset($this->_param1)) {
				$this->_controller->{$this->_action}($this->_param1);
			} else {
				$this->_controller->{$this->_action}();
			}
		} elseif (class_exists($this->_controller)) {
			$this->_action = 'index';
			$this->_controller = new $this->_controller($this->_classRef, $this->_action);
			$this->_controller->index();
		} else {
			// Fallback if controller not found
			$this->_classRef = 'Items';
			$this->_controller = 'ItemsCtrl';
			$this->_action = 'index';
			$this->_controller = new $this->_controller($this->_classRef, $this->_action);
			$this->_controller->index();
		}
	}


	/**
	 * Show errors if environment is development
	 */
	private function setReporting()
	{
		if (DEVELOPMENT_ENVIRONMENT) {
			error_reporting(E_ALL);
			ini_set('display_errors', 'On');
		} else {
			error_reporting(E_ALL);
			ini_set('display_errors', 'Off');
			ini_set('log_errors', 'On');
			ini_set('error_log', ROOT . DS . 'logs' . DS . 'errors.log');
		}
	}


	/**
	 * Recursive function to strip slashes
	 */
	function stripslashes_deep($value)
	{
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		return $value;
	}


	/**
	 * Removes magic quotes from $_GET, $_POST and $_COOKIE
	 */
	private function removeMagicQuotes()
	{
		if (get_magic_quotes_gpc()) {
			$_GET		= stripslashes_deep($_GET);
			$_POST		= stripslashes_deep($_POST);
			$_COOKIE	= stripslashes_deep($_COOKIE);
		}
	}


	/**
	 * Removes registered globals
	 */
	private function unregisterGlobals()
	{
		if (ini_get('register_globals')) {
			$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
			foreach ($array as $value) {
				foreach ($GLOBALS[$value] as $key => $var) {
					if ($var === $GLOBALS[$key]) {
						unset($GLOBALS[$key]);
					}
				}
			}
		}
	}


	/**
	 * Parse URL to get controller, method and params
	 */
	private function parseURL()
	{
		if (isset($_GET['url'])) {
			$url = explode('/', $_GET['url']);

			// If elements are not set or empty, null them
			$this->_classRef =	(isset($url[0]) && !empty($url[0]) ? ucwords($url[0])		: null);
			$this->_action =	(isset($url[1]) && !empty($url[1]) ? strtolower($url[1])	: null);
			$this->_param1 =	(isset($url[2]) && !empty($url[2]) ? $url[2]				: null);
			$this->_param2 =	(isset($url[3]) && !empty($url[3]) ? $url[3]				: null);
			$this->_param3 =	(isset($url[4]) && !empty($url[4]) ? $url[4]				: null);
		}
	}
}
