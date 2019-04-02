<?php
	$name = $_POST['name'];
	$name = (string)$name;
	$price = $_POST['price'];
	$price = (float)$price;
	
	$nameH = $_POST['nameH'];
	$nameH = (string)$nameH;
	$priceH = $_POST['priceH'];
	$priceH = (float)$priceH;
	$imgUploaded = basename($_FILES["fileToUpload"]["name"]);
	
  		if(!(empty($imgUploaded))){
			$connect2 = mysqli_connect('localhost','root','','cart');
			$query2 = "SELECT image FROM products WHERE name='$nameH'";
			$result = mysqli_query($connect2,$query2);
			$row = mysqli_fetch_array($result);
			
			$image = $row['image'];
			echo $image;
			$path='C:/xampp/htdocs/shop/';
			unlink($path.$image);
			include('C:/xampp/htdocs/shop/reupload.php');
			
			$connect = mysqli_connect('localhost','root','','cart');
			$query = "UPDATE products SET name='$name', price='$price', image='$imgUploaded' WHERE name='$nameH'";
			mysqli_query($connect,$query);
		}else{
			$connect = mysqli_connect('localhost','root','','cart');
			$query = "UPDATE products SET name='$name', price='$price' WHERE name='$nameH'";
			mysqli_query($connect,$query);
		}
		header("Location: http://localhost/shop/cartLog.php");
?>