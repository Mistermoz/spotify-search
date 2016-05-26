<?php
class SongsController extends AppController {
	public $scaffold;
  public $components = array('RequestHandler');

  public function index() {
  	if(isset($this->params->query['q']) && isset($this->params->query['types'])) {
  		$songs = $this->Song->find('all', array('conditions' => array('q' => $this->params->query['q'], 'limit' => 20, 'types' => $this->params->query['types'])));
  	}

    $this->set(compact('songs'));
    $this->set('_serialize', array('songs'));
  }
}