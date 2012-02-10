<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AppController {
	
	public $alias = "F&B";
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view', 'thursday', 'friday', 'saturday');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', $this->alias);
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$this->set('days', array(
			'Thursday, April 12, 2012' => array('controller' => 'menus', 'action' => 'thursday'),
			'Friday, April 13, 2012' => array('controller' => 'menus', 'action' => 'friday'),
			'Saturday, April 14, 2012' => array('controller' => 'menus', 'action' => 'saturday'),
		));
	}
	public function thursday(){
		$todays_date = __('Thursday, April 12, 2012');
		$this->set('title_for_layout', $todays_date);
		$this->set('todays_date', $todays_date);
		$this->set('today', $this->Menu->find('all', $this->_getIndexCondsOnDate(2012, 04, 12)));
		$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => 'menus', 'action' => 'index')));
	}
	public function friday(){
		$todays_date = __('Friday, April 13, 2012');
		$this->set('title_for_layout', $todays_date);
		$this->set('todays_date', $todays_date);
		$this->set('today', $this->Menu->find('all', $this->_getIndexCondsOnDate(2012, 04, 13)));
		$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => 'menus', 'action' => 'index')));
	}
	public function saturday(){
		$todays_date = __('Saturday, April 14, 2012');
		$this->set('title_for_layout', $todays_date);
		$this->set('todays_date', $todays_date);
		$this->set('today', $this->Menu->find('all', $this->_getIndexCondsOnDate(2012, 04, 14)));
		$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => 'menus', 'action' => 'index')));
	}
	
	private function _getIndexCondsOnDate($year, $month, $day){
		return array(
			'conditions' => array( 
				"AND" => array(
					array('Menu.date >=' => date("Y-m-d H:i:s", mktime(0, 0, 0, $month, $day, $year))),
					array('Menu.date <= ' =>  date("Y-m-d H:i:s", mktime(23, 59, 59, $month, $day, $year)))
				)
			),
			'order' => array('Menu.date ASC'),
		);
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
		$this->set('title_for_layout', $menu['Menu']['name']);
		$this->set('prevpage_for_layout', array(
			'title' => ucwords(date('l', strtotime($menu['Menu']['date']))), 
			'routing' => array('controller' => $this->params['controller'], 'action' => strtolower(date('l', strtotime($menu['Menu']['date']))))
		)); // Reroute to the day from whence you came
		
	}
}