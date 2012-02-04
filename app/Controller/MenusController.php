<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$params = array(
			"order" => array('Menu.date ASC')
		);
		$this->Menu->recursive = 1;
		$this->set('menus', $this->Menu->find('all', $params));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$menu = $this->Menu->read(null, $id);
		$this->set('menu', $menu);
		$this->set('title_for_layout', $menu['Menu']['name']." &mdash; Menus");
	}
}