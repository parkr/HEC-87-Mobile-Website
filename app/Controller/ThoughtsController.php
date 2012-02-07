<?php
App::uses('AppController', 'Controller');
/**
 * Thoughts Controller
 *
 * @property Thought $Thought
 */
class ThoughtsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$this->set('thoughts', $this->Thought->find('all'));
	}
}
