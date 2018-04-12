<?php 
	class UserController extends Controller{

		/*
			User Roles:
			1 - Administrator
			2 - Meneger
			3 - Customer
		*/
		
		public function login(){
			if($this->auth->isAuth()){  // if user authorised
				$this->route->redirect(''); // redirect to home page
			}else{
				if(isset($_POST['login'])){ 
					$user=$this->model->getUserData();
					if(count($user)>0){  // if user found save data to SESSION 
						$data=array('auth'=>1,'role'=>intval($user[0]['role']),'user'=>intval($user[0]['id']));
						$this->auth->setAuthData($data);
						$this->route->redirect('');
					}else{
						$error_massage='Incorect Login or Password';
						$var=compact($error_massage);
						$this->view->show($var,'login');
					}
				}else{
					$this->view->show(null,'login');
				}
			}
		}
		
		public function logout(){
			$this->auth->unsetAuthData();
			$this->route->redirect('');
		}
		
		public function registration(){
			if(isset($_POST['login'])){
				$res=$this->model->addNewUser();
				if($res){
					$this->route->redirect('user/login');
				}else{
					$massage=$this->model->error_massage;
					$var=compact('massage');
					$this->view->show($var,'registeration');
				}
			}else{
				$this->view->show(null,'registeration');
			}
		}
		
		public function profile(){
			$auth_data=$this->auth->getAuthData();
			if($auth_data['auth']){
				$orders=$this->model->getOrederList($auth_data); // getlist orders of user
				$allow_change=($auth_data['role']==3?false:true); //  if user is meneger or admin
				$vars=compact('orders','allow_change');
				$this->view->show($vars,'profile');
			}else{
				$this->route->redirect('user/login');
			}
		}
	}

?>