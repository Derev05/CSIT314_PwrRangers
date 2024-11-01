<?php
session_start();// Start the session

function logout() {
	session_unset(); // Unset all session variables
	session_destroy(); // Destroy the session
	header("Location: index.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
	logout();
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
	
</head>
<body>
	<nav class="py-2 bg-primary-subtle border-bottom">
		<div class="container d-flex flex-wrap">
		  <ul class="nav me-auto">
			<li class="nav-item"><a href="#" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
			<?php
			if(isset($_SESSION['username'])){
				if($_SESSION['role'] === 'Admin') {
					echo '<li class="nav-item"><a href="adminDashBoard.html" class="nav-link link-dark px-2">User Management</a></li>';
				} elseif($_SESSION['role'] === 'Buyer') {
					echo '<li class="nav-item"><a href="#" class="nav-link link-dark px-2">Buy Car</a></li>';
				} elseif($_SESSION['role'] === 'Seller') {
					echo '<li class="nav-item"><a href="#" class="nav-link link-dark px-2">Sell Car</a></li>';
				} elseif($_SESSION['role'] === 'Agent') {
					echo '<li class="nav-item"><a href="#" class="nav-link link-dark px-2">Car Listings</a></li>';
				}
			}
			?>
			</li>
		</ul>
		  </ul>
		  <ul class="nav">
			<?php		
			if(isset($_SESSION['username'])){
				echo '<li class="nav-item"><a class="nav-link link-dark px-2">'.$_SESSION['username'].'</a></li>';
				echo '<li class="nav-item">
						<form action="navbar.php" method="POST">
							<button type="submit" name="logout" class="nav-link link-dark px-2">
							Log Out
							</button>
						</form>
					</li>';
			} else {
			echo '<li class="nav-item"><a href="LoginPage.php" class="nav-link text-primary link-dark px-2">Login</a></li>';
			echo '<li class="nav-item"><a href="signUp.html" class="nav-link link-dark px-2">Sign up</a></li>';
			}
			?>
		  </ul>
		</div>
	  </nav>
	  <header class="py-3 mb-4 border-bottom">
		<div class="container d-flex flex-wrap justify-content-center">
		  <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
			<img src="assets/images/placeholderlogo.png">
		</a>
		  <form class="col-12 col-lg-auto mb-3 mb-lg-0">
			<input type="search" class="form-control" placeholder="Search..." aria-label="Search">
		  </form>
		</div>
	  </header>
</body>
</html>