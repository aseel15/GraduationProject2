<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$car_image = isset($_POST['car_image']) ? $_POST['car_image'] : "";
		$car_type = isset($_POST['car_type']) ? $_POST['car_type'] : "";
		$car_price = isset($_POST['car_price']) ? $_POST['car_price'] : "";
		$car_provider = isset($_POST['car_provider']) ? $_POST['car_provider'] : "";

		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "graduation_project";
		
		$conn = new mysqli($server_name, $username, $password, $dbname);
		if($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "insert into car (car_image, car_type, car_price, car_provider) values('".$car_image."','".$car_type."','". $car_price . "','" . $car_provider . "')" ;
		if ($conn->query($sql) == TRUE) {
			echo "New car posted successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

	}	
		
?>