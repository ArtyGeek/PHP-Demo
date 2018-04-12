<?php
	class OrderController extends Controller{
		
		public function action(){ 
			$this->view->show(null,'');
		}
		
		public function complite(){ 
			$offer_id=$_REQUEST['offer'];
			$count=$_REQUEST['count'];
			$offer=$this->model->getOffer($offer_id);
			$vars=compact('offer','count');
			$this->view->show($vars,'complite');
		}
		
		public function save(){           // create new order 
			if(isset($_POST['offer'])){
				$user=-1;
				$offer=$_POST['offer'];
				$client_name='';
				$client_email='';
				$client_phone=$_POST['client_phone'];
				$amount=$_POST['amount'];
				$price=$_POST['price'];
				if($this->auth->isAuth()){   // get user data from DB id user is authorised else get user data from REQUEST data
					$data=$this->auth->getAuthData();
					$user=intval($data['user']);
					$user_data=$this->model->getUserData($user);
					$client_name=$user_data['name'];
					$client_email=$user_data['email'];
				}else{
					$client_name=$_POST['client_name'];
					$client_email=$_POST['client_mail'];
				}
				$insert=$this->model->order($user,$offer,$client_name,$client_email,$client_phone,$amount,$price); // save order to DB
				if($insert){
					$basket=$this->auth->getBasketData();  // update basket data in session
					$offer=intval($id);
					$ikey=0;
					foreach($basket as $key=>$item){
						if(intval($item['id'])==intval($id)){
							$ikey=$key;
							break;
						}
					}
					unset($basket[$ikey]);
					$this->auth->updateBasketData($basket);
					$this->route->redirect('basket');
				}else{
				}
			}
		}
		
		
		public function edit($id){  //  get for for editing orders if user has permision
			$auth_data=$this->auth->getAuthData();
			if($auth_data['auth']){
				if($auth_data['role']==3){
					$this->route->redirect('user/profile');
				}else{
					if(isset($_POST['status_delivery'])&&isset($_POST['status_payment'])){
						$order=$this->model->changeStaus($id);
						if($order) $this->route->redirect('user/profile');
					}else{
						$order=$this->model->getOreder($id);
						$vars=compact('order');
						$this->view->show($vars,'edit');
					}
				}
			}
		}
	}

?>