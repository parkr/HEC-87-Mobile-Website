<?php
App::uses('AppController', 'Controller');
/**
 * Maps Controller
 *
 * @property Map $Map
 */
class MapsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('statler', 'sha', 'cornell', 'collegetown', 'ithaca');
	}
	
	public $name = "Maps";
	
	public function index(){
		$this->set("title_for_layout", $this->name);
		$this->set("maps", $this->Map->find('all', array('order' => 'Map.order ASC')));
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
	}
	public function statler(){
		$this->set("title_for_layout", $this->_makeTitle("The Statler Hotel"));
		$this->set('prevpage_for_layout', array('title' => $this->name, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}
	public function sha(){
		$this->set("title_for_layout", $this->_makeTitle("The School of Hotel Administration"));
		$this->set('prevpage_for_layout', array('title' => $this->name, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}
	public function collegetown(){
		$this->set("title_for_layout", $this->_makeTitle("Collegetown"));
		$this->set('prevpage_for_layout', array('title' => $this->name, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}
	public function ithaca(){
		$this->set("title_for_layout", $this->_makeTitle("Downtown Ithaca"));
		$this->set('prevpage_for_layout', array('title' => $this->name, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}
	
	private function _makeTitle($pageTitle){
		return $pageTitle;
	}
}
