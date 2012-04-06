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
	
	public function add(){
		public function add() {
			if ($this->request->is('post')) {
				$this->Thought->create();
				if ($this->Thought->save($this->request->data)) {
					$this->Session->setFlash(__('Thank you for your feedback! It has been submitted.'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Oh no! Something went wrong! Please, try again.'));
				}
			}
		}
	}
}
