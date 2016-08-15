<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere un nombre de usuario',
                'allowEmpty' => false
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere una contraseña',
                'allowEmpty' => false
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'carnetizer')),
                'message' => 'Por favor ingrese un rol de usuario válido',
                'allowEmpty' => false
            )
        )
    );
	public function beforeSave($options = array()) {
	    if (isset($this->data['User']['password'])) {
	        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	    }
    	return true;
	}
}

?>
