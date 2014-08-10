<?php

// Set some usefull constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
set_include_path( get_include_path() . PATH_SEPARATOR . ROOT);

// Load config
require_once ('app' . DS . 'config' . DS . 'config.php');
require_once ('app' . DS . 'lib' . DS . 'shared.php');

// Load base classes
require_once ('app' . DS . 'lib' . DS . 'Application.php');
require_once ('app' . DS . 'lib' . DS . 'Controller.php');
require_once ('app' . DS . 'lib' . DS . 'Model.php');
require_once ('app' . DS . 'lib' . DS . 'Template.php');

// Run app
$app = new Application();

?>
