<?php
	class OfferController extends Controller{
		
		function action(){ // get all products
			$list=$this->model->getOffers();
			$vars=compact('list');
			$this->view->show($vars,'');
		}
		
		function view($offer){ // view one product
			$data=$this->model->getOfferData($offer);
			$vars=compact('data');
			$this->view->show($vars,'view');
		}
	}

?>