<?
	class UserModel extends Model{
		public $error_massage;
		
		public function getUserData(){ // get user with sended credentials
			$login=$_POST['login'];
			$password=$_POST['password'];
			$hash=md5($password);
			$condition=array("AND"=>array(array('login',$login),array('password',$hash))); 
			$user=$this->db_select('test_users',array('condition'=>$condition));
			return $user;
		}
		
		public function addNewUser(){
			if(isset($_POST['login'])){   // registration data validating
				$login=$_POST['login'];
			}else{
				return false;
			}
			if(isset($_POST['password'])){
				$password=$_POST['password'];
			}else{
				$this->error_massage='Some required fileds is empty!';
				return false;
			}
			if(isset($_POST['password_repeat'])){
				$password_repeat=$_POST['password_repeat'];
			}else{
				$this->error_massage='Some required fileds is empty!';
				return false;
			}
			if(isset($_POST['name'])){
				$name=$_POST['name'];
			}else{
				$this->error_massage='Some required fileds is empty!';
				return false;
			}
			if(isset($_POST['email'])){
				$this->error_massage='Some required fileds is empty!';
				$email=$_POST['email'];
			}else{
				return false;
			}
			// checking, is exist user with same login
			$logins=$this->db_select('test_users',array('fields'=>array('login'),'condition'=>array('login',$login)));
			if(count($logins>0)){
				$this->error_massage='User with this login is exist!';
				return false;
			}
			if($password==$password_repeat){
				$password=md5($password);
				$created=$this->thisDataTime();
				// save user data into DB
				$insert=$this->db_insert('test_users',array('fields'=>array('name','email','login','password','role','created'),'values'=>array($name,$email,$login,$password,3,$created)));
				return $insert;
			}else{
				return false;
			}
		}
		
		public function getOrederList($auth_data){ // 
			$join=array(
				array('table'=>'test_statuses as ts1','source'=>'test_orders.status_delivery','target'=>'ts1.id'),
				array('table'=>'test_statuses as ts2','source'=>'test_orders.status_payment','target'=>'ts2.id'),
				array('table'=>'test_offer as tof','source'=>'test_orders.offer','target'=>'tof.id'),
				array('table'=>'test_users as tus','source'=>'test_orders.user','target'=>'tus.id','type'=>'LEFT')
			);
			$fields=array('test_orders.id','test_orders.offer','tof.name as offername','test_orders.client_name','test_orders.client_mail','test_orders.client_phone','test_orders.status_delivery','ts1.name as delivery','test_orders.status_payment','ts2.name as payment','test_orders.amount','test_orders.price','test_orders.created','tus.name');
			if($auth_data['auth']&&($auth_data['role']==3)){
				$condition=array('test_orders.user',$auth_data['user'],'=');
			}else{
				$condition=array('test_orders.user',-2,'>');
			}
			$res=$this->db_select('test_orders',array('join'=>$join,'condition'=>$condition,'fields'=>$fields));
			return $res;
		}
	}
	
	
?>