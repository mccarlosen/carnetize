<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));


	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));

	// Rutas para el Controller Connections
	Router::connect('/', array('controller' => 'connections', 'action' => 'index'));
	Router::connect('/load_data', array('controller' => 'connections', 'action' => 'load_data_source'));
	Router::connect('/list_connections', array('controller' => 'connections', 'action' => 'list_connections'));
	Router::connect('/add_connection', array('controller' => 'connections', 'action' => 'add_connection'));
	Router::connect('/on_off_connection', array('controller' => 'connections', 'action' => 'on_off_connection'));
	Router::connect('/edit_connection', array('controller' => 'connections', 'action' => 'edit_connection'));
	Router::connect('/delete_connection', array('controller' => 'connections', 'action' => 'delete_connection'));
	Router::connect('/on_off_ds/:id',
		array('controller' => 'connections', 'action' => 'on_off_connection'),
		array('pass' => array('id'), 'id' => '[0-9]+')
	);
	Router::connect('/edit_connection/:id',
		array('controller' => 'connections', 'action' => 'edit_connection'),
		array('pass' => array('id'), 'id' => '[0-9]+')
	);
	Router::connect('/delete_connection/:id',
		array('controller' => 'connections', 'action' => 'delete_connection'),
		array('pass' => array('id'), 'id' => '[0-9]+')
	);

	// Rutas para UsersController
	Router::connect('/system_users', array('controller' => 'users', 'action' => 'index'));

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
