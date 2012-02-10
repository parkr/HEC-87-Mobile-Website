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
		$this->Auth->allow('view', 'thursday', 'friday', 'saturday');
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$this->set('days', array(
			'Thursday, April 12, 2012' => array('controller' => 'events', 'action' => 'thursday'),
			'Friday, April 13, 2012' => array('controller' => 'events', 'action' => 'friday'),
			'Saturday, April 14, 2012' => array('controller' => 'events', 'action' => 'saturday'),
		));
	}
	public function thursday(){
		$this->set('title_for_layout', $event['Event']['name']);
		$this->set('today', $this->Event->find('all', $this->_getIndexCondsOnDate(2012, 04, 12)));
		$this->set('prevpage_for_layout', array('title' => "Program", 'routing' => array('controller' => 'events', 'action' => 'index')));
	}
	public function friday(){
		$this->set('title_for_layout', $event['Event']['name']);
		$this->set('today', $this->Event->find('all', $this->_getIndexCondsOnDate(2012, 04, 13)));
		$this->set('prevpage_for_layout', array('title' => "Program", 'routing' => array('controller' => 'events', 'action' => 'index')));
	}
	public function saturday(){
		$this->set('title_for_layout', $event['Event']['name']);
		$this->set('today', $this->Event->find('all', $this->_getIndexCondsOnDate(2012, 04, 14)));
		$this->set('prevpage_for_layout', array('title' => "Program", 'routing' => array('controller' => 'events', 'action' => 'index')));
	}
	
	private function _getIndexCondsOnDate($year, $month, $day){
		return array(
			'conditions' => array( 
				"AND" => array(
					array('Event.end_time >' => date("Y-m-d H:i:s")),
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
		$event = $this->Event->read(null, $id);
		$this->set('event', $event);
		$this->set('title_for_layout', $event['Event']['name']);
		$this->set('prevpage_for_layout', array(
			'title' => ucwords(date('l', strtotime($event['Event']['start_time']))), 
			'routing' => array('controller' => $this->params['controller'], 'action' => strtolower(date('l', strtotime($event['Event']['start_time']))))
		)); // Reroute to the day from whence you came
	}
}