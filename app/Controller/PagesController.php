<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController {
	private $rss_feed_url = "http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=HtlEzraCornell";
	private $rss_item;
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('home', 'updates', 'faqs', 'feedback', 'contact', 'about');
	}
	
	public function home(){
		$this->set("title_for_layout", "Home");
	}
	public function updates(){
		$this->set("title_for_layout", "Updates");
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		
		App::import('Utility', 'Xml');
		$parsed_xml =& Xml::build($this->rss_feed_url);
		$this->rss_item = Xml::toArray($parsed_xml);
		$this->set('data', $this->rss_item['rss']['channel']['item']);
	}
	public function faqs(){
		$this->set("title_for_layout", "FAQs");
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
	}
	public function feedback(){
		$this->set("title_for_layout", "Feedback");
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
	}
	public function contact(){
		$this->set("title_for_layout", "Contact");
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
	}
	public function about(){
		$this->set("title_for_layout", "About");
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
	}
}
