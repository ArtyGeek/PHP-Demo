<?
	class OfferModel extends Model{
		
		function getOffers(){ /* product list */
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
			$offers=$this->db_select('test_offer',array('fields'=>$fields,'join'=>$join,'group'=>'test_offer.id'));
			return $offers;
		}
		
		function getOfferData($inc){ /* get prodact info */
			$condition=array('test_offer.id',$inc,'=');

			$fields=array(
				'test_offer.id',
				'test_offer.name',
				'test_offer.description',
				'test_offer.price','test_catalog.id as cataloginc',
				'test_catalog.name as catname',
				'SUM(DISTINCT test_amount_offers.amount) as amount',
				'SUM(test_orders.amount) as oreders'
			);

			$join=array(
				array(
					'table'=>'test_amount_offers',
					'source'=>'test_offer.id',
					'target'=>'test_amount_offers.offer'
				),
				array(
					'table'=>'test_orders',
					'source'=>'test_offer.id',
					'target'=>'test_orders.offer',
					'type'=>'LEFT'
				),
				array(
					'table'=>'test_catalog',
					'source'=>'test_catalog.id',
					'target'=>'test_offer.catalog'
				)				
			);
			$offer=$this->db_select('test_offer',array('fields'=>$fields,'join'=>$join,'condition'=>$condition,'group'=>'test_offer.id'));
			$images=$this->db_select('test_offer_photo',array('fields'=>array('id','name'),'condition'=>array('offer',$inc)));
			$data=array('offer'=>$offer[0],'images'=>$images);
			return $data;
		}
	}
?>