<?php
class UsersController extends AppController {

	public $components = array('Session');

	public function isAuthorized($user){
		if($user['role'] == 'admin'){
			if(in_array($this->action, array('index', 'view','add', 'edit', 'delete'))){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}

	public function beforeFilter(){
		$this->Auth->allow('logout');
		parent::beforeFilter();
	}

	public function login() {
		if($this->Auth->login()){
			$this->redirect('/');
		}
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect('/');
	        }
		    $this->Session->setFlash(__('Usuario o Contraseña inválidos, vuelva a intentarlo.'));
		}
		$this->set('title_for_layout', 'Inicio de Sesión');
		$this->response->disableCache();
	}

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	public function index(){
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null){
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__("Inválido Usuario."));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add(){
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__("El usuario a sido creado."));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__("Hubo un error a intentar guardar."));
		}
	}

	public function edit($id = null){
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__("Inválido Usuario."));
		}
		//actualiza el usuario
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__("El usuario ha sido actualizado"));
				return $this->redirect(array("action" => "index"));
			}

			$this->Session->setFlash(__("Hubo un error al intentar actualizar."));
		}else{
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null){
		$this->request->onlyAllow('post');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__("Inválido Usuario."));
		}
		//alimina al usuario
		if ($this->User->delete()) {
			$this->Session->setFlash(__("El usuario ha sido eliminado."));
			return $this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__("Hubo un error al intentar eliminar al usuario."));
		return $this->redirect(array('action' => 'index'));
	}
}
?>
