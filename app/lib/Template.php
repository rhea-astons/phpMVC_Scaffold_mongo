<?php
/**
 * Template class. Used to render views
 *
 * @package    phpMVC_Scaffold_mongo
 * @author     Raphael Santos <raph.snts@gmail.com>
 * @copyright  2014 Raphael Santos
 * @license    http://opensource.org/licenses/MIT 	The MIT License (MIT)
 * @link       http://github.com/raphsnts/phpMVC_Scaffold_mongo
 */
class Template
{
	protected $_variables;
	protected $_classRef;
	protected $_action;


	/**
	 * Constructor
	 * @param string $classRef
	 * @param string $action
	 */
	function __construct($classRef, $action) {
		$this->_classRef = $classRef;
		$this->_action = $action;
	}


	/**
	 * Sets variables to template
	 * @param string $name
	 * @param mixed $value
	 */
	public function set($name, $value)
	{
		$this->_variables[$name] = $value;
	}


	/**
	 * Renders the view with specific header and footer or default ones.
	 */
	public function render()
	{
		extract($this->_variables);

		// Include header
		if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $this->_classRef . DS . 'header.tpl')) {
			include (ROOT . DS . 'app' . DS . 'views' . DS . $this->_classRef . DS . 'header.tpl');
		} else {
			include (ROOT . DS .'app' . DS . 'views' . DS . 'header.tpl');
		}

		// Include main content
		include (ROOT . DS . 'app' . DS . 'views' . DS . $this->_classRef . DS . $this->_action . '.tpl');

		// Include footer
		if (file_exists(ROOT . DS .'app' . DS . 'views' . DS . $this->_classRef . DS . 'footer.tpl')) {
			include (ROOT . DS . 'app' . DS . 'views' . DS . $this->_classRef . DS . 'footer.tpl');
		} else {
			include (ROOT . DS . 'app' . DS . 'views' . DS . 'footer.tpl');
		}
	}
}
