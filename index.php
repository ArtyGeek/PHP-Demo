<?php 
	require 'core/controller.php';
	require 'core/model.php';
	require 'core/view.php';
	require 'core/route.php';
	require 'core/auth.php';
	require 'config.php';
	
	$routes=new Route();
	$routes->setDefault('home'); // set default controller name
	$routes->parseUri();
	
	$view=new View();
	$root_dir=getcwd();
	$path_controller=realpath($root_dir.$routes->controller);
	$path_model=realpath($root_dir.$routes->model);
	if($path_controller&&$path_model){
		require $path_controller;
		require $path_model;
		$classController=$routes->classNames['controller'];
		$classModel=$routes->classNames['model'];
		$controller=new $classController();
		$controller->route=$routes;
		$model=new $classModel();
		$model->setConfig($dbconfig);
		$view->basket=Authorization::getBasketData();
		$view->auth=Authorization::isAuth();
		$view->root=$routes->root;
		$view->temp_path=$routes->view;
		$controller->model=$model;
		$controller->view=$view;
		if(method_exists($controller,$routes->action)){
			call_user_func_array(array($controller,$routes->action),$routes->values);
		}else{
			header('HTTP/1.0 404 Not Found');
			$view->notFound();
		}
	}else{
		header('HTTP/1.0 404 Not Found');
		$view->notFound();
	}
?>
