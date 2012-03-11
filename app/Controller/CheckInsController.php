<?php
App::uses('AppController', 'Controller');
/**
 * CheckIns Controller
 *
 * @property CheckIn $CheckIn
 * @property AuthComponent $Auth
 */
class CheckInsController extends AppController {

/**
 * log method
 *
 * @return void
 */
	public function check_in($event_id) {
		$output = array(
			'success' => false,
			'message' => 'Error: not a POST or PUT request',
			'user_id' => AuthComponent::user('id'),
			'event_id' => $event_id
		);
		if($this->request->is('post') || $this->request->is('put')){
			if($output['user_id']){
				if($event_id){
					$this->CheckIn->create();
					$data = array('CheckIn' => array(
						'event_id' => $event_id,
						'user_id' => $output['user_id'],
						'datetime' => date('Y-m-d H:i:s')
					));
					if ($this->CheckIn->save($data)) {
						$output['success'] = true;
						$output['message'] = "Checked in!";
					} else {
						$output['message'] = "Could not check you in.";
					}
				}else{
					$output['message'] = "No event id submitted.";
				}
			}else{
				$output['message'] = "You must be logged in to check in to events.";
			}
		}else{
			$output['message'] = "You must submit data as a POST or PUT request.";
		}
		$this->set('output', $output);
	}
	
}
