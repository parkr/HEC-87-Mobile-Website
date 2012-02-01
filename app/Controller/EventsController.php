<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */
class EventsController extends AppController {

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
		$this->set('thursday', $this->Event->find('all', $this->_getIndexCondsOnDate(2012, 04, 12)));
		$this->set('friday', $this->Event->find('all', $this->_getIndexCondsOnDate(2012, 04, 13)));
		$this->set('saturday', $this->Event->find('all', $this->_getIndexCondsOnDate(2012, 04, 14)));
	}
	
	private function _getIndexCondsOnDate($year, $month, $day){
		return array(
			'conditions' => array( 
				"AND" => array(
					array('Event.start_time >=' => date("Y-m-d H:i:s", mktime(0, 0, 0, $month, $day, $year))),
					array('Event.start_time <= ' =>  date("Y-m-d H:i:s", mktime(23, 59, 59, $month, $day, $year)))
				)
			),
			'order' => array('Event.start_time ASC'),
		);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->set('event', $this->Event->read(null, $id));
	}
}