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
		header("Location: http://localhost/shop/cartLog.php");
		exit;
		}
    }
?>
<?php 
$product_ids = array();
//session_destroy();

//check if Add to Cart has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
	if(isset($_SESSION['shopping_cart'])){
		
		//keep track of how many products are in the shopping cart
		$count = count($_SESSION['shopping_cart']);
		
		//create sequential array for matching array keys to product ids'
		$product_ids = array_column($_SESSION['shopping_cart'], 'id');
	
		if (!in_array(filter_input(INPUT_GET,'id'), $product_ids)){
		$_SESSION['shopping_cart'][$count] = array
		(
			'id' => filter_input(INPUT_GET,'id'),
			'name' => filter_input(INPUT_POST,'name'),
			'price' => filter_input(INPUT_POST,'price'),
			'quantity' => filter_input(INPUT_POST,'quantity')
		);
		}
		else {//product already exists, increase quantity
			//match array key to id of the product being added to the cart
			for ($i = 0; $i < count($product_ids); $i++){
				if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
					// add item quantity to the existing product in the array
					$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
				}
			}
		}
	}
	else {//if shopping cart doesn't exist, create first porudct with array key 0
		//create array using submitted form data, start from key 0 and fill it with values
		$_SESSION['shopping_cart'][0] = array
		(
			'id' => filter_input(INPUT_GET,'id'),
			'name' => filter_input(INPUT_POST,'name'),
			'price' => filter_input(INPUT_POST,'price'),
			'quantity' => filter_input(INPUT_POST,'quantity')
		);
	}
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
	//loop through all products in the shopping cart until it matches with GET id
	foreach($_SESSION['shopping_cart'] as $key => $product){
		if($product['id'] == filter_input(INPUT_GET, 'id')){
			//remove product from the shopping cart when it matches with the GET id
			unset($_SESSION['shopping_cart'][$key]);
		}
	}
	//reset session array keys so they match with $product_ids numeric array
	$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}
//pre_r($_SESSION);

function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
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
						<a class="nav-link" href="http://localhost/shop/home.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="http://localhost/shop/cart.php">Checkout<span class="sr-only">(current)</span></a>
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

		<!-- Fetch all products -->
		<div class="container" id="div">
			<?php 
				$connect = mysqli_connect('localhost','root','','cart');
				if(!empty($_POST['search'])){
					$search = $_POST['search'];
					$search = (string)$search;
					$query = "SELECT * FROM products WHERE name LIKE '%$search%' ORDER by id ASC";
				}else $query = 'SELECT * FROM products ORDER by id ASC';
				
				$result = mysqli_query($connect,$query);

				if($result):
					if(mysqli_num_rows($result)>0):
					while($product = mysqli_fetch_assoc($result)):
			?>
				<div class="col-md-3 col-sm-6" style="float:left;">
					<form method="post" action="cart.php?action=add&id=<?php echo $product['id']; ?>">
						<div class="products">
							<img class="img-fluid" src="<?php echo $product['image']; ?>"/>
							<h4 class="text-info"><?php echo $product['name']; ?></h4>
							<h4>$ <?php echo $product['price']; ?></h4>
							<input type="text" name="quantity" class="form-control" value="1" />
							<input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
							<input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
							<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
								   value="Add to Cart" />
						</div>
					</form>
				</div>
			<?php
				endwhile;
			endif;
		endif;
		?>
		<!-- Cart table formatting -->
			<div style="clear:both"></div>
			<br />
			<div class="table-responsive">
				<table class="table">
					<tr><th colspan="5"><h3>Order Details</h3></th></tr>
					<tr>
						<th width="40%">Product Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
				
					<?php
					if(!empty($_SESSION['shopping_cart'])):
		
					$total = 0;
				
					foreach($_SESSION['shopping_cart'] as $key => $product):
					?>
				
					<tr>
						<td><?php echo $product['name']; ?></td>
						<td><?php echo $product['quantity']; ?></td>
						<td>$ <?php echo $product['price']; ?></td>
						<td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
						<td>
							<a href="cart.php?action=delete&id=<?php echo $product['id']; ?>";
								<div class="btn-danger">Remove</div>
							</a>
						</td>
					</tr>
		
					<?php
					$total = $total + ($product['quantity'] * $product['price']);
					endforeach;
					?>
				
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<tr>
					<!-- Show checkout button only if the shopping cart is not empty -->
						<td colspan="5">
				
							<?php
							if (isset($_SESSION['shopping_cart'])):
							if (count($_SESSION['shopping_cart']) > 0):
							?>
			
							<a href="#" class="button">Checkout</a>
				
							<?php endif; endif; ?>
			
						</td>
					</tr>
			
					<?php
					endif;
					?>
		
				</table>
			</div>			
		</div>
		
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
