<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "LiteDb";
	error_reporting(E_ERROR | E_PARSE);
	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE LiteDb";
	if ($conn->query($sql) === TRUE) {
	  echo "Database created successfully";
	}
	$conn->close();
	$query = "CREATE TABLE Img (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(100)  NULL,
	thumb VARCHAR(200)  NULL,
	status bit(1),
	description VARCHAR(200)  NULL
	)";
	$conn2 = new mysqli($servername, $username, $password,$database);
	if ($conn2->query($query) === TRUE) {
  		echo "Table  created successfully";
	}
	$conn2->close();  
	session_unset();
 	$id=$_GET['key'];
 	if ($id=="c"){
		require_once  'Client/Controller/ImgController.php';
	    $controller = new ImgController();	
	    $controller->mvcHandler();
 	}else{
		require_once  'Admin/Controller/ImgController.php';
	    $controller = new ImgController();	
	    $controller->mvcHandler();
 	}
?>