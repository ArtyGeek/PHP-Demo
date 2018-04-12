<?
	class OrderModel extends Model{
		
		function getOffer($id){ /* get product data by ID */
			$join=array(
				'table'=>'test_offer_photo',
				'source'=>'test_offer.id',
				'target'=>'test_offer_photo.offer'
			);
			$fields=array(
				'test_offer.id',
				'test_offer.name',
				'test_offer.price',
				'test_offer_photo.id as photoinc',
				'test_offer_photo.name as photoname'
			);
			$offers=$this->db_select('test_offer',array('fields'=>$fields,'join'=>$join,'group'=>'test_offer.id','condition'=>array('test_offer.id',$id,'=')));
			return $offers[0];
		}
		
		public function getUserData($id){ /* get user information */
			$condition=array('id',$id,'=');
			$user=$this->db_select('test_users',array('condition'=>$condition));
			return $user[0];
		}
		
		public function order($user,$offer,$client_name,$client_email,$client_phone,$amount,$price){ /* create new order in DB */
			$created=$this->thisDataTime();
			$insert=$this->db_insert(
				'test_orders',
				array(
					'fields'=>array('offer','user','client_name','client_mail','client_phone','status_delivery','status_payment','amount','price','created','updated'),
					'values'=>array($offer,$user,$client_name,$client_email,$client_phone,1,2,$amount,$price,$created,$created)
				)
			);
			return $insert;
		}
		
		public function getOreder($id){ /* get order info */
			$join=array(
				array('table'=>'test_offer as tof','source'=>'test_orders.offer','target'=>'tof.id'),
				array('table'=>'test_users as tus','source'=>'test_orders.user','target'=>'tus.id','type'=>'LEFT')
			);
			$fields=array('test_orders.id','test_orders.offer','tof.name as offername','test_orders.client_name','test_orders.client_mail','test_orders.client_phone','test_orders.status_delivery','test_orders.status_payment','test_orders.amount','test_orders.price','test_orders.created','tus.name');
			$condition=array('test_orders.id',$id,'=');
			$res=$this->db_select('test_orders',array('join'=>$join,'condition'=>$condition,'fields'=>$fields));
			return $res[0];
		}
		
		public function changeStaus($id){ /* change order status */
			$data=array(array('field'=>'status_delivery','value'=>intval($_POST['status_delivery'])),
				array('field'=>'status_payment','value'=>intval($_POST['status_payment']))	
			);
			$condition=array('id',$id,'=');
			$res=$this->db_update('test_orders',array('data'=>$data,'condition'=>$condition));
			return $res;
		}
	}
?>