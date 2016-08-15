<?php
App::uses('AppModel', 'Model');
class Connection extends AppModel {
    public $validate = array(
        'name_connection' => array(
            'rule-1' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Este campo es requerido'
            ),
            'rule-2' => array(
                'rule' => 'isUnique',
                'message' => 'Este nombre ya ha sido tomado.'
            )
        ),
        'host_db' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Este campo es requerido'
        ),
        'name_db' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Este campo es requerido'
        ),
        'user_db' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Este campo es requerido'
        ),
        'pwd_db' => array(
            'rule' => 'notEmpty',
            'allowEmpty' => true,
            'message' => 'Es recomendable proteger la BD con un Password'
        ),
        'name_table_db' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false
        )
    );
}
?>
