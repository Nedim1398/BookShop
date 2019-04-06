<?php
session_start();
?>

<!DOCTYPE html>
<html>

	<head>
		<title>Shopping Cart</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="cart.css"/>
	</head>

	<body>
	<!-- Navigation Bar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="http://localhost/shop/aboutLOG.php">Bookworm Adventures</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link active" href="http://localhost/shop/homeLOG.php">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://localhost/shop/cartLOG.php">Checkout</a>
					</li>
				</ul>
	
				<form class="form-inline my-2 my-lg-0" name="form" method="post">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="search" name="search" id="search">
					<button class="btn btn-info" type="submit">Search</button>
				</form>
	
				<a href="http://localhost/shop/home.php"><button class="btn btn-info" style="margin-left:5px" onclick="func2()">Logout - <?php echo $_SESSION["activeUser"];?></button></a>
				<button class="btn btn-info" style="margin-left:5px" onclick="document.getElementById('id01').style.display='block'">Register</button>
			</div>
		</nav>
		
		<!-- Sign Up -->
		<div id="id01" class="modal">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" action="" method="post">
			
				<div class="containerReg">
					<h1>Sign Up</h1>
					<p>Please logout before creating a new account.</p>
					<hr>
					
					<div class="clearfix">
						<button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-dark btn-block">Cancel</button>
					</div>
				</div>
			</form>
		</div>

		<!-- New Product Form -->
		<div>
			<form class="modal-content" action="upload.php" method="post" enctype="multipart/form-data">
				<div class="containerReg">
					<h1>New Product</h1>
					<p>Adding new product to database:</p>
					<hr>
					<label for="name"><b>Name:</b></label>
					<input type="text" placeholder="Enter Product Name" name="name" required>

					<label for="price"><b>Price:</b></label>
					<input type="text" placeholder="0.00" name="price" required>

					<label><b>Select image to upload:</b>
					<input type="file" name="fileToUpload" id="fileToUpload"></label>

					<div class="clearfix">
						<button type="submit" class="btn btn-success btn-block" name="register">Add</button>
					</div>
				</div>
			</form>
		</div>
		
		<!-- Fetch all users for editing -->
<?php	
		$connect = mysqli_connect('localhost','root','','cart');
		$query = "SELECT * FROM users";
		$result = mysqli_query($connect,$query);	
		while($row = mysqli_fetch_array($result)) {
                            $email = $row["email"];
							$password = $row["password"];
							?>
				<div class="col-md-3 col-sm-6" style="float:left;">
					<form method="post" action="">
						<div class="users">
							<input type="text" name="email" value="<?php echo $row['email']; ?>" />
							<input type="text" name="password" value="<?php echo $row['password']; ?>" />
							<input type="hidden" name="emailH" value="<?php echo $row['email']; ?>" />
							<input type="hidden" name="passwordH" value="<?php echo $row['password']; ?>" />
							<input type="submit" formaction="deleteUser.php" style="margin-top:5px;" class="btn btn-danger"
								   value="Delete User" />
							<input type="submit" formaction="editUser.php" style="margin-top:5px;" class="btn btn-success"
								   value="Edit User" />
						</div>
					</form>
				</div>
<?php
                }
				
?>

		<script>
		// Get the modal
		var modal = document.getElementById('id01');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		</script>

		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
		<script src="cart.js"></script> 
	</body>
</html>
