<?	
	/* батківський клас моделей */

	class Model{
		private $db_link;
		protected $dbhost;
		protected $dbuser;
		protected $dbpass;
		public $dbase;
		public $dbtabel;
		protected $connection;
		
		
		public function __construct(){
			
		}
		
		public function setConfig($config){  /* set database config  */
			$this->dbhost=$config['host'];
			$this->dbuser=$config['user'];
			$this->dbpass=$config['password'];
			$this->dbase=$config['database'];
		}
		
		public function db_query($sql){  /* exequitng SQL query  */
			//var_dump($sql);
			$this->db_connect();
			$query=mysql_query($sql,$this->db_link);
			if(!$query){
				return false;
			}else{
				if($query===true){
					return $query;
				}else{
					$arr=array();
					for($i=0;$i<mysql_num_rows($query);$i++){
						$arr[$i]=mysql_fetch_assoc($query);
					}
					return $arr;
				}
			}
			$this->close();
		}
		 
		public function thisDataTime(){  /* getting current date string  */
			$date=date('Y-m-d H:i:s');
			return $date;
		}
		
		public function db_connect(){  /* connetctiong to DB  */
			$this->db_link = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass);
			if(!$this->db_link){
				$this->connection=false;
			}else{
				mysql_select_db($this->dbase);
			}
			return $this->connection;
		}
		
		private function parseCondition($ar_condition){  /* generetion sql conditions from array */
			$cond='';
			if(isset($ar_condition[2])){ /* checking of condtions keywords  */
				$expretion=$ar_condition[2];
				switch($expretion){
					case 'LIKE':
						$cond=$ar_condition[0].' LIKE \'%'.$ar_condition[1].'%\' ';
					break;
					case 'IN':
						$list=implode(',',$ar_condition[1]);
						$cond=$ar_condition[0].' IN ('.$list.') ';
					break;
					default:
						$ist=is_string($ar_condition[1]);
						if(!$ist) $ist=is_null($ar_condition[1]);
						$cond=$ar_condition[0].$ar_condition[2].($ist?"'":"").$ar_condition[1].($ist?"'":"").' ';
					break;
				}
			}else{
				$ist=is_string($ar_condition[1]);
				if(!$ist) $ist=is_null($ar_condition[1]);
				$cond=$ar_condition[0].'='.($ist?"'":"").$ar_condition[1].($ist?"'":"").' ';
			}
			return $cond;
		}
		
		public function db_select($table,$params){   /* creating select query for data  */
			$fields=' * ';
			if(isset($params['fields'])){
				$fields='';
				foreach($params['fields'] as $key => $field){
					$fields=$fields.($key==0?'':',').$field;
				}
			}
			$condition=''; 
			if(isset($params['condition'])){  /* creation query conditions part from paramters array */
				$condition=' WHERE ';
				if(isset($params['condition']['AND'])||(isset($params['condition']['OR']))){
					$isAnd=false;
					if(isset($params['condition']['AND'])){
						foreach($params['condition']['AND'] as $Akey => $Avalue){
							$temp=Model::parseCondition($Avalue);
							$condition=$condition.($Akey==0?'':' AND ').$temp;
						}
						$isAnd=true;
					}
					if(isset($params['condition']['OR'])){
						foreach($params['condition']['OR'] as $Okey => $Ovalue){
							$temp=Model::parseCondition($Avalue);
							$condition=$condition.((($Okey==0)&&(!$isAnd))?'':' OR ').$temp;
						}
					}
				}else{
					$temp=Model::parseCondition($params['condition']); 
					$condition=$condition.$temp;
				}
			}
			/* create ordering part of query form params  */
			$order='';  
			if(isset($params['order'])){
				$direct=' ASC ';
				if(isset($params['order']['asc'])){
					$direct=($params['order']['asc']==0?' ASC':' DESC');
				}
				$order='Order By '.$params['order']['field'].$direct;
			}
			/* creation join parts of query from params */
			$join=' ';
			if(isset($params['join'])){
				$isSimple=false;
				foreach($params['join'] as $_join){
					if(is_array($_join)){
						$join=$join.(isset($_join['type'])?(' '.$_join['type']):'').' JOIN '.$_join['table'].' ON('.$_join['source'].'='.$_join['target'].') ';
					}else{
						$isSimple=true;
						break;
					}
				}
				if($isSimple){
					$join=$join.(isset($params['join']['type'])?(' '.$params['join']['type']):'').' JOIN '.$params['join']['table'].' ON('.$params['join']['source'].'='.$params['join']['target'].') ';
				}
			}
			/* generation limit parts of query from params */
			$limit='';
			if(isset($params['limit'])){
				$limit=' LIMIT '.$params['limit'];
			}
			$offset='';
			if(isset($params['offset'])){
				$limit=' OFFSET '.$params['offset'];
			}
			$group='';
			if(isset($params['group'])){
				$group=' GROUP BY '.$params['group'];
			}
			/* join of all query parts and executing SQL query */
			$SQL="SELECT $fields FROM $table $join $condition $group $order $limit $offset";
			$result=$this->db_query($SQL);
			return $result;
		}
		
		public function db_update($table,$params){    /* creation updating SQL query  */
			$fields='';
			$condition='';
			if(isset($params['data'])&&isset($params['condition'])){   /* generation query conditions part from paramters array */
				foreach($params['data'] as $key=>$val){
					$fields=$fields.($key==0?' ':',').$val['field'].'='.$val['value'];
				}
				if(isset($params['condition']['AND'])||(isset($params['condition']['OR']))){
					$isAnd=false;
					if(isset($params['condition']['AND'])){
						foreach($params['condition']['AND'] as $Akey => $Avalue){
							$temp=Model::parseCondition($Avalue);
							$condition=$condition.($Akey==0?'':' AND ').$temp;
						}
						$isAnd=true;
					}
					if(isset($params['condition']['OR'])){
						foreach($params['condition']['OR'] as $Okey => $Ovalue){
							$temp=Model::parseCondition($Avalue);
							$condition=$condition.((($Okey==0)&&(!$isAnd))?'':' OR ').$temp;
						}
					}
				}else{
					$temp=Model::parseCondition($params['condition']);
					$condition=$condition.$temp;
				}

				/* join of all query parts and executing SQL query */
				$SQL="UPDATE $table SET $fields WHERE $condition";
				$result=$this->db_query($SQL);
				return $result;
			}else{
				return false;
			}
		}
		
		public function db_insert($table,$params){  /* creation inserting data SQL query  */
			$fields='';
			$values='';
			if(isset($params['fields'])){ /* create list of fields names  for SQL query*/
				$fields='(';
				foreach($params['fields'] as $key => $field){
					$fields=$fields.($key==0?'':',').$field;
				}
				$fields=$fields.')';
			}
			if(isset($params['values'])){ /* create list of values for SQL query */
				$values=' VALUES ';
				$isSimple=false;
				foreach($params['values'] as $key=>$_value){
					if(is_array($_value)){
						$values=$values.($key==0?'':',').'(';
						foreach($_value as $_key=>$__value){
							if(is_string($__value)){
								$values=$values.($_key==0?'':',')."'".$__value."'";
							}else{
								$values=$values.($_key==0?'':',').$__value;
							}
						}
						$values=$values.')';
					}else{
						$isSimple=true;
						break;
					}
				}
				if($isSimple){
					$values=$values.'(';
					foreach($params['values'] as $_key=>$_value){
						if(is_string($_value)){
							$values=$values.($_key==0?'':',')."'".$_value."'";
						}else{
							$values=$values.($_key==0?'':',').$_value;
						}
					}
					$values=$values.')';
				}

				/* join of all query parts and executing SQL query */
				$SQL="INSERT INTO $table $fields $values";
				$result=$this->db_query($SQL);
				return $result;
			}else{
				return false;
			}
		}
		
		public function db_drop($table,$params){  /* creation SQL query of droping data form table  */
			if(isset($params['condition'])){
				$condition=$params['condition']['fields'].'='.$params['condition']['value'];
				$SQL="DELETE FROM $table $condition";
				$result=$this->db_query($SQL);
				return $result;
			}else{
				return false;
			}
		}
		
		public function close(){
			mysql_close($this->db_link);
		}
	}
?>