<?php

use Router\Router;
	
	require '../vendor/autoload.php';
	
	define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
	//http://localhost/backofficedefine('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
		
		if (session_status() === PHP_SESSION_NONE) {
			ini_set('session.cookie_samesite', 'None');
			ini_set('session.cookie_secure', '1');
			//session_set_cookie_params(['samesite' => 'None', "secure"=>16]);
			session_start();
			if (!isset($_COOKIE['theme']) ) {
                $_COOKIE['theme'] = 'app';
            }
		}

$url = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '/backoffice/') + strlen('/backoffice/'));
	if(strpos($url, 'public/index.php') === 0){
		$url = '/';
	}
	$_GET['url'] = $url;
	
	$router = new Router($url);




	$router->get('/', 'App\DashboardController@dashboard');
	$router->get('login', 'App\AccessController@login');
	$router->post('loginForm', 'App\AccessController@loginForm');
	$router->get('logout', 'App\AccessController@logout');
	/* Access */
	$router->get('access/users_manager', 'App\AccessController@usersManager');
	$router->get('access/menu_edit/:id', 'App\AccessController@menuEdit');



	try {
		$router->run();
	} catch (Exception $e) {
		//return header('Location: backoffice/errors/error404');
		var_dump($e);
		//return $e->getMessage();
	}
