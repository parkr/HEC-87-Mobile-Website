<?php
App::uses('AppController', 'Controller');
/**
 * Thoughts Controller
 *
 * @property Thought $Thought
 */
class ThoughtsController extends AppController {

	public function beforeFilter() {
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->allow('add', 'edit'); // Letting users register themselves
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$this->set('title_for_layout', 'Feedback');
		$this->set('events', 
			$this->Thought->Event->find(
				'all', 
				array(
					'conditions' => array(
						'Event.can_leave_feedback' => '1', 
						'Event.start_time <=' => date('Y-m-d H:i:s'),
					), 
					'order' => array('Event.start_time ASC')
				)
			)
		);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Thought->id = $id;
		if (!$this->Thought->exists()) {
			throw new NotFoundException(__('Invalid feedback ID.'));
		}
		$this->set('thought', $this->Thought->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($event_id) {
		
		// Check if this event has already been sent feedback by this user
		if(($user_id = AuthComponent::user('id')) > 0){
			$thought = $this->Thought->find('first', array('conditions' => array('Thought.event_id' => $event_id, 'Thought.user_id' => $user_id)));
			$this->Thought->id = $thought['Thought']['id'];
			if($this->Thought->exists()){
				//$this->redirect(array('action' => 'edit', $event_id));
				$this->Session->setFlash('You have already submitted feedback for this event.');
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Thought->id = NULL;
			}
		}
		
		if ($this->request->is('post')) {
			$this->Thought->create();
			if ($this->Thought->save($this->request->data)) {
				$this->Session->setFlash(__('Your feedback has been saved. Thank you!'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Oops! Something went wrong with submitting your feedback. Please, try again.'));
			}
		}
		$this->set('event', $this->Thought->Event->find('first', array('conditions' => array('Event.id' => $event_id))));
		$this->set('options', $this->Thought->options);
		$this->set('questions', $this->Thought->questions);
		
		$this->set('title_for_layout', 'Submit Feedback');
		$this->set('prevpage_for_layout', array('title' => "Feedback", 'routing' => array('action' => 'index')));
		
		//$events = $this->Thought->Event->find('list');
		//$users = $this->Thought->User->find('list');
		//$this->set(compact('events', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout', 'Edit Feedback');
		$this->set('prevpage_for_layout', array('title' => "Feedback", 'routing' => array('action' => 'index')));
		$this->Thought->id = $id;
		if (!$this->Thought->exists()) {
			throw new NotFoundException(__('Invalid thought'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Thought->save($this->request->data)) {
				$this->Session->setFlash(__('Your feedback has been updated. Thank you!'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Oops! Something went wrong with submitting your feedback. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Thought->read(null, $id);
			$this->set('event', $this->Thought->Event->find('first', array('conditions' => array('Event.id' => $this->request->data['Thought']['event_id']))));
			$this->set('options', $this->Thought->options);
			$this->set('questions', $this->Thought->questions);
		}
		//$events = $this->Thought->Event->find('list');
		//$users = $this->Thought->User->find('list');
		//$this->set(compact('events', 'users'));
	}
}
