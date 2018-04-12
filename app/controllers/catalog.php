<?php 
	class CatalogController extends Controller{
	
		function action(){ //list f catalogs
			$list=$this->model->getCatalogs();
			$vars=compact('list');
			$this->view->show($vars,'');
		}
		
		function view($cat){ // view one catalog
			$data=$this->model->getOffersCatalog($cat);
			$vars=compact('data');
			$this->view->show($vars,'view');
		}
	}

?>