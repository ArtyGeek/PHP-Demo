<?php
	class BasketController extends Controller{
		
		public function action(){
			$data=$this->auth->getBasketData(); // get basket data form session
			//var_dump($data);
			$result=$this->model->getBasketOffers($data); // get products data from basket
			if($result){
				$vars=compact('data','result');
				$this->view->show($vars,'');
			}else{
				$this->view->show(null,'');
			}
		}
		
		public function add(){
			$basket=$this->auth->getBasketData(); // save bas
			$id=$_REQUEST['id'];
			$amount=$_REQUEST['value'];
			$add_finish=false;
			foreach($basket as $key=>$item){
				if(intval($item['id'])==intval($id)){
					$add_finish=true;
					$basket[$key]['amount']=intval($item['amount'])+intval($amount);
				}
			}
			if(!$add_finish){
				$next=count($basket);
				$basket[$next]=array('id'=>intval($id),'amount'=>intval($amount));
			}
			$this->auth->updateBasketData($basket);
			print 'true';
		}
		
		public function remove($id){
			$basket=$this->auth->getBasketData();
			$offer=intval($id);
			$basket_2=array();
			$ikey=0;
			foreach($basket as $key=>$item){
				if(intval($item['id'])==intval($id)){
					//$ikey=$key;
				}else{
					$basket_2[$ikey]=$item;
					$ikey++;
				}
			}
			//unset($basket[$ikey]);
			$this->auth->updateBasketData($basket_2);
			$this->route->redirect('basket');
		}
	}

?>