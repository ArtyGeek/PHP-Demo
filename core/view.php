<?
	/* клас видів */
	
	class View{
		public $temp_path;
		public $auth;
		public $root;
		public $basket=array();
		
		public function excute($module,$vars){ /* loading page templates */
			if($vars!=null) extract($vars);
			if($module=='content'){	 /*  */
				$puth='.'.$this->temp_path.'index.php';
				$real_puth=realpath($puth);
				include $real_puth;
			}else{
					
				$puth='.'.$this->temp_path.'/'.$module.'.php';
				$real_puth=realpath($puth);
				include $real_puth;
			}
		}
		
		public function countOffers(){ /* method of counting orders in bucket */
			$intOffer=0;
			foreach($this->basket as $offer){
				$intOffer=$intOffer+intval($offer['amount']);
			}
			return $intOffer;
		}
		
		public function show($vars,$tpl){  /* loading page view */
			if($vars!=null) extract($vars);
			$template='content';
			if($tpl!=''){
				$template=$tpl;
			}
			include realpath('./app/views/layout.php');
		}
		
		public function notFound(){  /* loading 404 template */
			include realpath('./app/views/layout.php');
		}
	}