<!-- Check if user exists before Login -->
<?php
session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['login']))
    {
        func2();
    }
    function func2()
    {
		$connect = mysqli_connect('localhost','root','','cart');
			$email = $_POST['email'];
			$email = (string)$email;
			$_SESSION["activeUser"]=$email;
			$psw = $_POST['psw'];
			$psw = (string)$psw;
			$query = "SELECT email FROM users WHERE email='$email' AND password='$psw' LIMIT 1";
		$result = mysqli_query($connect,$query);
		if (!$result || mysqli_num_rows($result)==0) { 
			echo '<div class="alert alert-danger" role="alert">LOGIN failed!</div>';
		}
		else{
		header("Location: http://localhost/shop/homeLog.php");
		exit;
		}
    }
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
		<a class="navbar-brand" href="http://localhost/shop/about.php">Bookworm Adventures</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link active" href="http://localhost/shop/home.php">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://localhost/shop/cart.php">Checkout</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0" name="form" method="post">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="search" name="search" id="search">
					<button class="btn btn-info" type="submit">Search</button>
				</form>
				<button class="btn btn-info" style="margin-left:5px" onclick="document.getElementById('id02').style.display='block'">Login</button>
				<button class="btn btn-info" style="margin-left:5px" onclick="document.getElementById('id01').style.display='block'">Register</button>
			</div>
		</nav>
		
		<!-- Sign Up -->
		<div id="id01" class="modal">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" action="" method="post">
				<div class="containerReg">
					<h1>Sign Up</h1>
					<p>Please fill in this form to create an account.</p>
					<hr>
					<label for="email"><b>Email</b></label>
					<input type="text" placeholder="Enter Email" name="email" required>

					<label for="psw"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="psw" required>

					<label for="psw-repeat"><b>Repeat Password</b></label>
					<input type="password" placeholder="Repeat Password" name="psw-repeat" required>

					<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

					<div class="clearfix">
						<button type="submit" class="btn btn-success btn-block" name="register">Register</button>
						<button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-dark btn-block">Cancel</button>
					</div>
				</div>
			</form>
		</div>

		<!-- Login -->
		<div id="id02" class="modal">
			<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" action="" method="post">
				<div class="containerReg">
					<h1>Login</h1>
					<hr>
					<label for="email"><b>Email</b></label>
					<input type="text" placeholder="Enter Email" name="email" required>

					<label for="psw"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="psw" required>

					<div class="clearfix">
						<button type="submit" class="btn btn-success btn-block" name="login">Login</button>
						<button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-dark btn-block">Cancel</button>
					</div>
				</div>
			</form>
		</div>

		<!-- Register New User -->
		<?php
			if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['register']))
			{
				func();
			}
			function func()
			{
				$connect = mysqli_connect('localhost','root','','cart');
					$email = $_POST['email'];
					$email = (string)$email;
					$psw = $_POST['psw'];
					$psw = (string)$psw;
					$query = "INSERT INTO users (email,password) VALUES('$email','$psw')";
				mysqli_query($connect,$query);
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

		// Get the modal
		var modal = document.getElementById('id02');

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
