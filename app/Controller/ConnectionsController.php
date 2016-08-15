<?php
class ConnectionsController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array(
		"Session",
		"RequestHandler"
	);

	public function isAuthorized($user){
		if (isset($user['role']) && $user['role'] === 'carnetizer'){
			$this->Auth->deny(array('add_connection', 'list_data_source'));
			if (in_array($this->action, array('index', 'load_data_source'))) {
				return true;
			}
		}
		if (isset($user['role']) && $user['role'] === 'admin'){
			if (in_array($this->action, array('add_connection', 'list_connections'))) {
				return true;
			}
		}
		return parent::isAuthorized($user);
	}

	public function index(){
		$this->set('title_for_layout', 'Inicio');
		$this->response->disableCache(); //Evitar que el navegador ponga la página en cache
	}

	public function load_data_source(){
		if ($this->Auth->login()) {
			$data_sources = $this->Connection->find('all', array(
				'conditions'=>array(
					'Connection.status' => 1
				)
			));
			if ($data_sources != false) {
				// Consultar todas las conexiones activas
				$this->set('connections',$data_sources);
			}
		}
	}

	public function add_connection(){
		if ($this->Auth->user('role') == 'admin') {
			if ($this->RequestHandler->isAjax()) {
				$request_json = null;
				$request = $this->request->data;
				$name_connection_exist = $this->Connection->find('first', array(
					'conditions' => array(
						'Connection.name_connection' => $request['name_connection']
					)
				));
				// Verificando si un DS con el mismo nombre no exista
				if ($name_connection_exist) {
					$request_json = array(
						"response" => 0
					);
				}else{
					$name_ds = "DS ".$request['name_connection'];
					$request['name_connection'] = $name_ds;
					// Guardando la data
					if ($this->Connection->save($request)) {
						$request_json = array(
							"response" => 1
						);
					}
				}
				echo $this->response->body(json_encode($request_json));
			}
		}
	}
	public function list_connections(){
		if ($this->Auth->login()){
			$request = $this->Connection->find('all');
			if ($request) {
				$this->set('list_connections', $request);
			}else{
				$request = array(
					'response' => 0
				);
				$this->set('response_json',$request);
				$this->render('ajax_view','ajax');
			}
		}
	}

	public function on_off_connection($ds = null){
		if ($this->Auth->user('role') == 'admin'){
			if ($this->RequestHandler->isAjax()) {
				$request_json = null; $mysqli_data = null;
				$connec_tmp = $this->Connection->findById($ds);

				// Probando conexión de ds
				$mysqli = @mysqli_connect($connec_tmp['Connection']['host_db'], $connec_tmp['Connection']['user_db'],
					$connec_tmp['Connection']['pwd_db'], $connec_tmp['Connection']['name_db']);
				if (!$mysqli) {
					$request_json = array(
						'response' => 'El DS no pudo ser activado. Verifique si existe o que los datos o la configuración del DS sean correctos.'
					);
					echo $this->response->body(json_encode($request_json));
				}
				// Varificando si el data source existe
				$table = $connec_tmp['Connection']['name_table_db'];
				$consult = "SELECT * FROM $table";
				$result = @$mysqli->query($consult);

				if ($result) { // Si hay resultados, el DS existe
					// Buscando el Status del DS
					$status_ds = $connec_tmp['Connection']['status'];

					if ($status_ds == 0) {
						$connec_tmp['Connection']['status'] = 1;
						// Guardando Cambios
						if($this->Connection->save($connec_tmp)){
							$request_json = array(
								'response' => 1
							);
						};
					}elseif($status_ds == 1){
						$connec_tmp['Connection']['status'] = 0;
						// Guardando Cambios
						if($this->Connection->save($connec_tmp)){
							$request_json = array(
								'response' => 0
							);
						};
					}

					$this->set('response_json',$request_json);
					$this->render('ajax_view','ajax');
				}

				if(!$result){
					$request_json = array(
						'response' => 'El DS no pudo ser activado. Verifique si existe o que los datos o la configuración del DS sean correctos.'
					);
					$this->set('response_json',$request_json);
					$this->render('ajax_view','ajax');
				}
			}
		}
	}

	public function edit_connection($ds = null){
		$request_json = null;
		if ($this->Auth->user('role') == 'admin') {
			if ($this->RequestHandler->isAjax()) {
				if (!empty($this->request->data)) {
					// Guardando la data editada
			        if ($this->Connection->save($this->request->data)) {
			            // Preparando json
			            $request_json = array(
							'response' => 1
						);
			        }else{
						// Preparando json
						$request_json = array(
							'response' => 0
						);
					}
					// Renderizando la respuesta en la vista
					$this->set('response_json',$request_json);
					$this->render('ajax_view','ajax');
				}else{
					// Buscando el DS a editar
					$this->set('response_json', $this->Connection->findById($ds));
					$this->render('ajax_view','ajax');
				}
			}
		}
	}

	public function delete_connection($ds = null){
		if ($this->Auth->user('role') == 'admin') {
			if ($this->RequestHandler->isAjax()) {
				if ($ds) {
					// Eliminar DS
					if ($this->Connection->delete($ds)) {
						$request_json = array(
							'response' => 1
						);
					}else{
						$request_json = array(
							'response' => 0
						);
					}
					// Renderizando la respuesta en la vista
					$this->set('response_json',$request_json);
					$this->render('ajax_view','ajax');
				}
			}
		}
	}
}
?>
