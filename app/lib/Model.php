<?php
/**
 * Model class. All models will extend this class
 *
 * @package    phpMVC_Scaffold_mongo
 * @author     Raphael Santos <raph.snts@gmail.com>
 * @copyright  2014 Raphael Santos
 * @license    http://opensource.org/licenses/MIT 	The MIT License (MIT)
 * @link       http://github.com/raphsnts/phpMVC_Scaffold_mongo
 */
class Model
{
	private $_connection;
	private $_result;
	private $_classRef;


	/**
	 * Constructor
	 * @param string $classRef
	 */
	function __construct($classRef) {
		$this->_classRef = $classRef;
		$this->connect();
	}


	/**
	 * Connects to the database
	 */
	private function connect()
	{
		try {
			if (defined('DB_USER') && defined('DB_PASS')) {
				$mongo = new MongoClient('mongodb://' . DB_USER . ':' . DB_PASS . '@' . DB_HOST);
			} else {
				$mongo = new MongoClient('mongodb://' . DB_HOST);
			}
			$this->_connection = $mongo->selectDB(DB_NAME);
		} catch (Exception $e) {
			die('Cannot connect to database: ' . $e->getMessage());
		}
	}


	/**
	 * Returns all the elements from the table associated to the model
	 * @return Item
	 */
	function getAll()
	{
		$class = get_called_class();
		$this->_result = $this->_connection->{get_called_class()}->find();
		$this->_result = iterator_to_array($this->_result);
		return $this->_result;
	}


	/**
	 * Returns the element "id" from the table associated to the model
	 * @param int $id
	 * @return array
	 */
	function getById($id)
	{
		$idArray = array( '_id' => new MongoId($id));
		$this->_result = $this->_connection->{get_called_class()}->findOne($idArray);
		return $this->_result;
	}

	function insert($array)
	{
		$this->_result = $this->_connection->{get_called_class()}->insert($array);
		return $array['_id'];
	}

	function delete($id)
	{
		$idArray = array( '_id' => new MongoId($id));
		$this->_result = $this->_connection->{get_called_class()}->remove($idArray);
	}
}
