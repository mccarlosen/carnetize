<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'connections',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'authError' => 'Inicie sesión para acceder al sistema',
            'authorize' => array('Controller')
		)
	);

	public function isAuthorized($user) {
	    if (isset($user['role']) && $user['role'] === 'admin') {
	        return true;
	    }
	    // Default
	    return false;
	}

	public function beforeFilter(){
		$this->set('logged_in', $this->Auth->loggedIn());
		$this->set('current_user', $this->Auth->user());
	}
}
