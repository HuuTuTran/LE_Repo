<?php
    require 'Model/Img.php';
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
                case 'insert' :                    
					$this->insert();
					break;	
                case 'detail' :                    
					$this->detail();
					break;					
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;
				case 'update' :					
					$this -> update();
					break;
				case 'updateProcess' :					
					$this -> updateProcess();
					break;										
				default:
                    $this->list();
			}
		}
		public function setLimit(){
         	$take=$_GET['take'];
			$_SESSION["take"] = $take;
			$this->paginate();
		}	
		public function paginate(){
           	$this->open_db();
           	$pagenum = (int)$_GET['pagenum'];
           	$take = 0;
			if ($_SESSION["take"] != null){
				$take = (int)$_SESSION["take"];
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
            include "Admin/View/list.php";
		}
        public function update(){
        	$id = (int)$_GET['id'];
           	$this->open_db();
            $query=$this->condb->prepare("SELECT * FROM `img` where id = ?");
			$query->bind_param("s",$id);			
			$query->execute();
			$res=$query->get_result();	
			$query->close();
			$this->close_db();
			$i = new img();                
            while($row = $res->fetch_assoc()){
            	$i->id = $row['id'];
            	$i->title = $row['title'];
            	$i->thumb = $row['thumb'];
            	$i->status = $row['status'];
            	$i->description = $row['description'];
            } 
            include "Admin/View/update.php";
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
            include "Admin/View/list.php";
        }
        public function getall(){
           	$this->open_db();
            $query=$this->condb->prepare("SELECT * FROM `img`");
			$query->execute();
			$res=$query->get_result();	
			$query->close();				
			$this->close_db();                
            $result= $res; 
            $_SESSION["take"]= $_SESSION["rowcount"];
            include "Admin/View/list.php";
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
            include "Admin/View/detail.php";
        }
         public function delete(){
         	$id=$_GET['id'];
			$this->open_db();
			$query=$this->condb->prepare("DELETE FROM IMG WHERE id=?");
			$query->bind_param("i",$id);
			$query->execute();
			$query->close();
			$this->close_db();
            $this->list();
        }
         public function insert(){
			try
			{
				$target_dir = "Resource/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				if(isset($_POST["submit"])) {
				  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				  if($check !== false) {
				    echo "File is an image - " . $check["mime"] . ".";
				    $uploadOk = 1;
				  } else {
				    echo "File is not an image.";
				    $uploadOk = 0;
				  }
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif") {
				  echo "only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
				}

				if ($uploadOk == 0) {
				  echo "your file was not uploaded.";
				} else {
				  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
				  } else {
				    echo "there was an error";
				  }
				}	        	
				$error='';
				$i=new img();
                $i->title = trim($_POST['title']);
                $i->thumb ='Resource/'.trim(htmlspecialchars(basename($_FILES["fileToUpload"]["name"])));
                $i->status = false;				
                $i->description = trim($_POST['description']);
                if($i->title =="" ||$i->thumb==""||$i->description==""||$uploadOk == 0 ){
					$error='Please fill all the fields';
        			include "Admin/View/insert.php";
            	}else{
	                $this->open_db();
					$query=$this->condb->prepare("INSERT INTO IMG (title,thumb,status,description) VALUES (?,?,?,?)");
					$query->bind_param("ssss",$i->title,$i->thumb,$i->status,$i->description);
					$query->execute();
					$query->close();
					$this->close_db();
	            	$this->list();
            	}		

			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
        }
         public function updateProcess(){
			try
			{	
				$i=new img();
				if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){
					$i->thumb = trim($_POST['thumb']);
				}else{
					$target_dir = "Resource/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					if(isset($_POST["submit"])) {
					  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					  if($check !== false) {
					    echo "File is an image - " . $check["mime"] . ".";
					    $uploadOk = 1;
					  } else {
					    echo "File is not an image.";
					    $uploadOk = 0;
					  }
					}
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif") {
					  		echo "only JPG, JPEG, PNG & GIF files are allowed.";
					  		$uploadOk = 0;
					}
					if ($uploadOk == 0) {
					  		echo "your file was not uploaded.";
					} else {
					  	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					    	$i->thumb = 'Resource/'.trim(htmlspecialchars(basename($_FILES["fileToUpload"]["name"])));
					  	}else {
					    	echo "there was an error";
					  	}
					}
				}
				$error= '';
                $i->title = trim($_POST['title']);
                $i->status = $_POST['status'];				
                $i->description = trim($_POST['description']);
                $i->id = $_POST['id'];
                $stt = false;
                if ($i->status != 0){
                	$stt = true;
                }
                if($i->title =="" ||$i->thumb==""||$i->description=="" ){
					$error='Please fill all the fields';
        			include "Admin/View/update.php";
            	}else{
	                $this->open_db();
					$query=$this->condb->prepare("UPDATE IMG SET title=?,thumb=?,status=?,description=? WHERE Id = ?");
					$query->bind_param("sssss",$i->title,$i->thumb,$stt,$i->description,$i->id);
					$query->execute();
					$query->close();
					$this->close_db();
	            	$this->list();
            	}

			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
        }

	}
?>