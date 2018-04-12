<?
	class HomeModel extends Model{
		
		function getOffers(){ /* get list of products */
			$join=array('table'=>'test_offer_photo','source'=>'test_offer.id','target'=>'test_offer_photo.offer');
			$fields=array('test_offer.id','test_offer.name','test_offer.price','test_offer_photo.id as photoinc','test_offer_photo.name as photoname');
			$offers=$this->db_select('test_offer',array('fields'=>$fields,'join'=>$join,'group'=>'test_offer.id'));
			return $offers;
		}
	}
?>