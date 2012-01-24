<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class MapsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('statler', 'sha', 'cornell', 'collegetown', 'ithaca');
	}
	
	public $name = "Maps";
	
	public function index(){
		$this->set("title_for_layout", $this->name);
	}
	public function statler(){
		$this->set("title_for_layout", $this->_makeTitle("The Statler Hotel"));
	}
	public function sha(){
		$this->set("title_for_layout", $this->_makeTitle("The School of Hotel Administration"));
	}
	public function collegetown(){
		$this->set("title_for_layout", $this->_makeTitle("Collegetown"));
	}
	public function ithaca(){
		$this->set("title_for_layout", $this->_makeTitle("Downtown Ithaca"));
	}
	
	private function _makeTitle($pageTitle){
		return "$pageTitle &raquo; $this->name";
	}
}
