<?
	/* */
	/* Class for working with sessions */
	class Authorization{
		static public function isAuth(){ /* verify user authorisation */
			session_start();
			if(isset($_SESSION['auth'])){
				if($_SESSION['auth']==1){
					return true;
				}else{
					return false;
				}
			}
		}
		
		public function setAuthData($data){ /* save authorisation data in session */
			session_start();
			$_SESSION['auth']=$data['auth'];
			$_SESSION['role']=$data['role'];
			$_SESSION['user']=$data['user'];
		}
		
		
		public function unsetAuthData(){ /* clear auth sesion data */
			session_start();
			unset($_SESSION['auth']);
			unset($_SESSION['role']);
			unset($_SESSION['user']);			
		}
		
		public function getAuthData(){ /* get user data from session */
			session_start();
			$data=array();
			$data['auth']=$_SESSION['auth'];
			$data['role']=$_SESSION['role'];
			$data['user']=$_SESSION['user'];
			return $data;
		}
		
		/* method for saving basket data  */
		
		public function updateBasketData($data){ /* update session basket data  */
			session_start();
			$str_basket='';
			foreach($data as $key=>$item){
				$str_basket=$str_basket.($key==0?'':';').$item['id'].':'.$item['amount'];
			}
			$_SESSION['basket']=$str_basket;
		}
		
		static public function getBasketData(){ /* get basket data form session */
			$arr_basket=array();
			session_start();
			if(isset($_SESSION['basket'])){
				if($_SESSION['basket']!=''){
					$str_basket=$_SESSION['basket'];
					$temp_arr=explode(';',$str_basket);
					foreach($temp_arr as $key=>$item){
						$temp=explode(':',$item);
						$arr_basket[$key]=array('id'=>$temp[0],'amount'=>$temp[1]);
					}
				}
			}
			return $arr_basket;
		}
	}
?>