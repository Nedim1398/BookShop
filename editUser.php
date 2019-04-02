<?php
			$email = $_POST['email'];
			$email = (string)$email;
			$password = $_POST['password'];
			$password = (string)$password;
			$emailH = $_POST['emailH'];
			$emailH = (string)$emailH;
			$passwordH = $_POST['passwordH'];
			$passwordH = (string)$passwordH;
		$connect = mysqli_connect('localhost','root','','cart');
		$query = "UPDATE users SET email='$email', password='$password' WHERE email='$emailH'";
		mysqli_query($connect,$query);
		header("Location: http://localhost/shop/homeLog.php");
?>