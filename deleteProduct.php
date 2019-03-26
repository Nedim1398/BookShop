<?php
			$name = $_POST['name'];
			$name = (string)$name;
			$price = $_POST['price'];
			$price = (float)$price;
			
		$connect2 = mysqli_connect('localhost','root','','cart');
		$query2 = "SELECT image FROM products WHERE name='$name'";
		$result = mysqli_query($connect2,$query2);
		$row = mysqli_fetch_array($result);
		$image = $row['image'];
		echo $image;
		$path='C:/xampp/htdocs/shop/';
		unlink($path.$image);
		
		$connect = mysqli_connect('localhost','root','','cart');
		$query = "DELETE FROM products WHERE name='$name'";
		mysqli_query($connect,$query);

		// TODO: ADD DELETING PICTURE FROM FOLDER
?>
<?php

?>