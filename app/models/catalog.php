<?php
	class CatalogModel extends Model{
		
		function getCatalogs(){ /* get list of all catalogs */
			return $this->db_select('test_catalog',array());
		}
		
		function getOffersCatalog($cat){ /* get catalog list for product */
			$catalog=$this->db_select('test_catalog',array('condition'=>array('id',$cat)));
			$join=array('table'=>'test_offer_photo','source'=>'test_offer.id','target'=>'test_offer_photo.offer');
			$fields=array('test_offer.id','test_offer.name','test_offer.price','test_offer_photo.id as photoinc','test_offer_photo.name as photoname');
			$offers=$this->db_select('test_offer',array('fields'=>$fields,'join'=>$join,'condition'=>array('test_offer.catalog',$cat),'group'=>'test_offer.id'));
			$data=array('catalog'=>$catalog[0],'offers'=>$offers);
			return $data;
		}
	}
?>