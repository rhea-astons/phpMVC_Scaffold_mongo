<?php
/**
 * Controller class. All controllers will extend this class
 *
 * @package    phpMVC_Scaffold_mongo
 * @author     Raphael Santos <raph.snts@gmail.com>
 * @copyright  2014 Raphael Santos
 * @license    http://opensource.org/licenses/MIT 	The MIT License (MIT)
 * @link       http://github.com/raphsnts/phpMVC_Scaffold_mongo
 */
class Controller
{
	protected $_classRef;
	protected $_model;
	protected $_template;
	protected $_action;


	/**
	 * Constructor
	 * @param string $classRef
	 * @param string $action
	 */
	function __construct($classRef, $action) {
		$this->_classRef = $classRef;
		$this->_action = $action;

		// Set model name
		$this->_model = trim($this->_classRef, 's');
		$this->_model = ucwords($this->_model);

		// Load model
		$this->_model = new $this->_model($this->_classRef);

		// Load template
		$this->_template = new Template($this->_classRef, $this->_action);
	}


	/**
	 * Shortcut to set variables on template
	 * @param string $name
	 * @param string $value
	 */
	function set($name, $value)
	{
		$this->_template->set($name, $value);
	}


	/**
	 * Destructor
	 */
	function __destruct()
	{
		if ($this->_template) {
			$this->_template->render();
		}
	}
}
