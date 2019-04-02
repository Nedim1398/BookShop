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
		header("Location: http://localhost/shop/aboutLog.php");
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
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="http://localhost/shop/about.php">Bookworm Adventures<span class="sr-only">(current)</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="http://localhost/shop/home.php">Home</a>
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
		
		<div class="about">
			<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus magna ac risus blandit placerat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent eget leo ut ante porttitor interdum non at dolor. Morbi sit amet lectus in ex ullamcorper lobortis eget sit amet nisl. In vitae felis dictum, pretium lorem at, ultricies arcu. Nullam in malesuada diam. Praesent quis magna a elit ultricies rutrum. Phasellus in malesuada justo. Morbi in vestibulum orci.
			</p><p>
			Nunc id orci ac odio ultrices facilisis. Curabitur elit eros, elementum id erat vel, placerat auctor tortor. Pellentesque consectetur neque at dictum faucibus. Curabitur vitae sem ultrices, semper magna ut, pellentesque velit. Sed eget placerat lacus, sit amet elementum quam. Curabitur nec magna malesuada, semper diam in, bibendum ex. Sed sodales lectus mi, non cursus ex semper nec. Fusce eleifend pharetra nibh eget rhoncus. Aenean non metus in quam porttitor ultrices sed eu mi.
			</p><p>
			Mauris fringilla mauris rhoncus diam commodo, semper semper velit tincidunt. Suspendisse et massa augue. Integer enim nibh, iaculis id varius quis, tristique vitae ex. Morbi euismod libero non aliquet ullamcorper. Curabitur lacus turpis, tincidunt ut justo vel, aliquam vehicula erat. Nam porttitor consectetur sem, vel viverra dolor aliquet sit amet. Cras aliquet sed nunc in consectetur. Duis eget ex ac sem dapibus iaculis. Donec lacinia, tellus ac lacinia facilisis, nisl diam sagittis ex, quis dapibus enim ligula id mauris.
			</p><p>
			Vivamus suscipit ac lacus at tristique. Aenean sit amet efficitur tortor, id faucibus risus. Nullam sagittis eget dui vel hendrerit. Sed dictum odio quam, ut congue diam varius quis. Nullam quis quam lobortis, aliquam nisi in, dictum quam. Mauris euismod tellus sed ullamcorper vestibulum. Praesent eu commodo tellus. Fusce condimentum nibh mi, et congue tellus convallis pellentesque. Curabitur at molestie erat. Curabitur purus odio, feugiat vel condimentum ac, fermentum tempor felis. Praesent et leo vulputate quam convallis maximus.
			</p><p>
			Nulla sodales tincidunt auctor. Nunc non mi diam. Fusce turpis nulla, pellentesque quis hendrerit id, porta eu quam. Nullam non volutpat nibh. Donec rutrum elit quis magna porttitor, a rutrum ligula cursus. Sed ante metus, pulvinar in ultricies at, dignissim id nulla. Sed in ipsum dapibus, semper tortor quis, vehicula quam. In vehicula purus arcu, vitae pretium nibh fermentum at. Aenean mollis lacinia lacinia. Mauris faucibus fringilla enim quis volutpat. 
			</p>
		</div>
		
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
		
		<script src="cart.js"></script>
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
		 
	</body>
</html>
