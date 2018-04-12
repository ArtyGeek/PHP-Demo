<?php
	class HomeController extends Controller{
		
		function action(){
			$data=$this->model->getOffers();
			$vars=compact('data');
			$this->view->show($vars,'');
		}
	}

?>