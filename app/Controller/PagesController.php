<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('home', 'updates', 'faqs', 'maps'); // Letting users register themselves
	}
	
	public function home(){
		$this->set("title_for_layout", "Home");
	}
	public function updates(){
		$this->set("title_for_layout", "Updates");
	}
	public function faqs(){
		$this->set("title_for_layout", "FAQs");
	}
	public function maps(){
		$this->set("title_for_layout", "Maps");
	}
}
