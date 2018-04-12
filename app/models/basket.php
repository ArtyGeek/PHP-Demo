<?
	class BasketModel extends Model{
		
		public function getBasketOffers($data){  /* get created orders */
			$list=array();
			foreach($data as $key=>$val){
				$list[$key]=$val['id'];
			}
			$join=array('table'=>'test_offer_photo','source'=>'test_offer.id','target'=>'test_offer_photo.offer');
			$fields=array('test_offer.id','test_offer.name','test_offer.price','test_offer_photo.id as photoinc','test_offer_photo.name as photoname');
			$condition=array('test_offer.id',$list,'IN');
			$offers=$this->db_select('test_offer',array('fields'=>$fields,'join'=>$join,'group'=>'test_offer.id','condition'=>$condition));
			return $offers;
		}
		
		public function add(){
			
		}
	}
?>