<?

	 /* Class of routings requests  */
	 /* path structure:  /%ControllerName%/%actionName%/%variable% */
	class Route{
		public $users_routes=array();
		public $controller;
		public $model;
		public $view;
		public $action;
		public $default=array();
		public $values=array();
		public $classNames=array('controller','model');
		public $puth_controllers='/app/controllers/';
		public $puth_model='/app/models/';
		public $puth_views='/app/views/';
		public $root='/';
		
		public function setDefault($name){   /* seting default routing data */
			$this->default['controller']=$name;
			$this->default['model']=$name;
			$this->default['view']=$name;
			$this->default['name']=ucfirst($name);
		}
		
		private function setDefaultValue(){  /* set default controllers names  */
			$controllerName=$this->default['controller'];
			$modelName=$this->default['model'];
			$viewName=$this->default['view'];
			$this->classNames['controller']=$this->default['name'].'Controller';
			$this->classNames['model']=$this->default['name'].'Model';
			$this->controller=$this->puth_controllers.$controllerName.'.php';
			$this->model=$this->puth_model.$modelName.'.php';
			$this->view=$this->puth_views.$viewName.'/';
		}
		
		public function parseUri(){  /* get controllers names by request URI  */
			$temp_uri=explode('?',$_SERVER['REQUEST_URI']);
			$routest=explode('/',$temp_uri[0]);
			$thisscript=explode('/', $_SERVER['SCRIPT_NAME']);
			$inc=0;
			foreach($thisscript as $key=>$val){  
				if($val=='index.php'){
					$inc=$key-1;
					break;
				}
			}
			for($i=0;$i<=$inc;$i++){
				if($routest[$i]!=''){
					$this->root=$this->root.$routest[$i].'/';
				}
			}
			if(isset($routest[$inc+1])){
				if(($routest[$inc+1]=='')||($routest[$inc+1]=='index.php')){ /* if path doesn't have controller name set default values */
					Route::setDefaultValue();
				}else{  /* get controller name form path and set controllers names  */
					$controllerName=$routest[$inc+1];
					$modelName=$routest[$inc+1];
					$viewName=$routest[$inc+1];
					$name=ucfirst($routest[$inc+1]);
					$this->classNames['controller']=$name.'Controller';
					$this->classNames['model']=$name.'Model';
					$this->controller=$this->puth_controllers.$controllerName.'.php';
					$this->model=$this->puth_model.$modelName.'.php';
					$this->view=$this->puth_views.$viewName.'/';
				}
			}else{
				Route::setDefaultValue();
			}
			/* if path has action set action name for controllers */
			if(isset($routest[$inc+2])){  
				$this->action=$routest[$inc+2];
				if($this->action=='') $this->action='action';
			}else{
				$this->action='action';
			}
			/* if path has variables save them in array */
			$nRoutes=count($routest);
			if($nRoutes>($inc+3)){
				$this->values=array();
				$increment=0;
				for($i=$inc+3;$i<$nRoutes;$i++){
					$this->values[$increment]=$routest[$i];
					$increment++;
				}
			}
			
		}
		
		public function redirect($newURL){ /* redirection to other pages  */
			if($newURL==''){
				$newURL='http://'.$_SERVER['SERVER_NAME'].$this->root;
			}else{
				$newURL='http://'.$_SERVER['SERVER_NAME'].$this->root.$newURL;
			}
			header('Location: '.$newURL);
		}
	}
?>