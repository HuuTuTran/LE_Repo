<?php	
	session_start();
	class imgController
	{
		public function open_db()
		{
			$this->condb=new mysqli("localhost","root","","LiteDb");
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		public function close_db()
		{
			$this->condb->close();
		}	
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{	
				case 'setLimit':
					$this->setLimit();
					break;
				case 'getall':
					$this->getall();
					break;
				case 'paginate':
					$this->paginate();
					break;
                case 'detail' :                    
					$this->detail();
					break;											
				default:
                    $this->list();
			}
		}
		public function setLimit(){
         	$take=$_GET['take'];
			$_SESSION["Ctake"] = $take;
			$this->paginate();
			//echo (int)$_SESSION["Ctake"] ;
		}
		public function paginate(){
           	$this->open_db();
           	$pagenum = (int)$_GET['pagenum'];
           	$take = 0;
			if ($_SESSION["Ctake"] != null){
				$take = (int)$_SESSION["Ctake"];
			}else{
           		$take = 5;
			}
			if($pagenum==0){
				$pagenum =1;
			}
			$skip = ($pagenum-1)*$take;
            $query=$this->condb->prepare("SELECT * FROM `img` LIMIT ?,?");
			$query->bind_param("ss",$skip,$take);
			$query->execute();
			$res=$query->get_result();	
			$query->close();				
			$this->close_db();                
            $result= $res; 
            include "Client/View/list.php";
		}	
        public function list(){
           	$this->open_db();
            $query=$this->condb->prepare("SELECT * FROM `img` LIMIT 0,5");
			$query->execute();
			$res=$query->get_result();	
			$query->close();
            $query2=$this->condb->prepare("SELECT COUNT(*) FROM img; ");
            $query2->execute();
            $res2 = $query2->get_result();
			$query2->close();
			$this->close_db();                
            $result= $res; 
            $total = $res2;
            include "Client/View/list.php";
        }
          public function detail(){
         	$id=$_GET['id'];
           	$this->open_db();
			$query=$this->condb->prepare("SELECT * FROM Img WHERE id=?");
			$query->bind_param("i",$id);
			$query->execute();
			$res=$query->get_result();	
			$query->close();				
			$this->close_db();                
            $result= $res; 
            include "Client/View/detail.php";
        }
        public function getall(){
           	$this->open_db();
            $query=$this->condb->prepare("SELECT * FROM `img`");
			$query->execute();
			$res=$query->get_result();	
			$query->close();				
			$this->close_db();                
            $result= $res; 
            include "Client/View/list.php";
        }
	}
?>