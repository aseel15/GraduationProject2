<?php

	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : "";
		$post = isset($_POST['post']) ? $_POST['post'] : "";       
		$date = isset($_POST['date']) ? $_POST['date'] : "";
        $rate = isset($_POST['rate']) ? $_POST['rate'] : "";
		
		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "graduation_project";
		$response=array();

		$conn = new mysqli($server_name, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		
		$sql = "insert into review (userId,date,review,rate) values ('" . $user_id . "','" . $date . "','" . $post . "','" . $rate . "')";
	    $sql2="select * from review where userId= '$user_id' ";
		
		$result=$conn->query($sql2);
		$row2 =mysqli_fetch_assoc($result);
		
		if(empty($row2)){
		if ($conn->query($sql) === TRUE) {
			$response['error'] = false;
			$response['message'] = "تمت إضافة التقييم";
		} else {
			$response['error'] = true;
			$response['message'] = "Error " . $conn->error;
			
		} }
		else{
		if(!empty($post))
		$sql = "update review set date='" . $date . "',review='" . $post . "',rate='" . $rate . "' where userId='" . $user_id . "'";
		else
		$sql = "update review set date='" . $date . "', rate='" . $rate . "' where userId='" . $user_id . "'";

		$result=$conn->query($sql);
		$response['error'] = false;
		
		}

		
		
	
		echo json_encode($response);

		$conn->close();
	
	}


?>