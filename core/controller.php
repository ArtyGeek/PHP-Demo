<?
	/* Base controller class */
	class Controller{
		public $model;
		public $view;
		public $route;
		public $auth;
		
		public function __construct(){
			$this->auth=new Authorization();
		}
				
		public function action(){
			
		}
	}
?>