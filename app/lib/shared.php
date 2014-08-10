<?php
/**
 * Autoload any required class
 * @param string $className
 */
function __autoload($className) {
	if (file_exists(ROOT . DS . 'app' . DS . 'lib' . DS . $className . '.php')) {
		require_once(ROOT . DS . 'app' . DS . 'lib' . DS . $className . '.php');
	} else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')) {
		require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
	} else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')) {
		require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
	} else {
		/* Error Generation Code Here */
	}
}
