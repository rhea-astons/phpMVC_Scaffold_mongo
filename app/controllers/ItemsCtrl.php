<?php
/**
 * Items Controller
 *
 * @package    phpMVC_Scaffold_mongo
 * @author     Raphael Santos <raph.snts@gmail.com>
 * @copyright  2014 Raphael Santos
 * @license    http://opensource.org/licenses/MIT 	The MIT License (MIT)
 * @link       http://github.com/raphsnts/phpMVC_Scaffold_mongo
 */
class ItemsCtrl extends Controller
{
	/**
	 * Index
	 */
	public function index()
	{
		$this->set('title', 'All items');
		$items = $this->_model->getAll();
		$this->set('items', $items);
	}


	/**
	 * View item by id
	 */
	public function view($id)
	{

		$item = $this->_model->getById($id);
		if($item) {
			$this->set('title', 'Item ' . $id);
			$this->set('item', $item);
		} else {
			header('Location: /items');
		}
	}

	public function add()
	{
		if (isset($_POST['name']) && !is_null($_POST['name'])) {
			$id = $this->_model->insert(array('name' => $_POST['name']));

			$this->_action = 'view';
			$this->_template = new Template($this->_classRef, $this->_action);

			$item = $this->_model->getById($id);
			$this->set('title', 'Item ' . $id);
			$this->set('item', $item);
		} else {
			$this->set('title', 'Add item');
		}
	}

	public function delete($id)
	{
		$this->_model->delete($id);
		header('Location: /item');
	}
}
