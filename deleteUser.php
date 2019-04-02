<?php
			$email = $_POST['email'];
			$email = (string)$email;
			$password = $_POST['password'];
			$password = (string)$password;
		
		$connect = mysqli_connect('localhost','root','','cart');
		$query = "DELETE FROM users WHERE email='$email'";
		mysqli_query($connect,$query);
		header("Location: http://localhost/shop/homeLog.php");
?>