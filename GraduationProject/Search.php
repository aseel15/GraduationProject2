<?php


	$email = "";
	$passworduser="";
	if(isset($_GET['email'])){
		$email = $_GET['email'];
	}
	if(isset($_GET['pass'])){
		$passworduser = $_GET['pass'];
	}
	
	
		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "graduation_project";
		$response=array();
		
		$conn = new mysqli($server_name, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "select * from userdata where email = '" . $email . "' and password= '" . $passworduser ."' ";
		
		$sql2 = "select password,phoneNum from userdata where email = '" . $email . "'";
		
		
		if(empty($passworduser)){
		$result = $conn->query($sql2);
		$row =mysqli_fetch_assoc($result);
			
		if(empty($row)){
			$response['error'] = true;
			$response['message']="الايميل غير صحيح";
		}
		else{
			$response['error'] = false;
			$response['password']= $row['password'];
			$response['phoneNum']=$row['phoneNum'];
		}
					
		}
		
		else{
		$result = $conn->query($sql);
		$row =mysqli_fetch_assoc($result);    
		
		if(empty($row)){
			$response['error'] = true;
			$response['message']="الإيميل أو كلمة السر غير صحيح ";
		}
		else{
			$response['error'] = false;
			$response['id']=$row['userId'];
			$response['role']=$row['role'];
			
		}
		
		}
		
					
		echo json_encode($response);
		
		$conn->close();
		
	
	
	




?>