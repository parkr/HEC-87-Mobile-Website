<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class FaqsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', "FAQs");
		$this->set('faqs', $this->Faq->find('all', array('order' => 'Faq.order ASC')));
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
	}
}
