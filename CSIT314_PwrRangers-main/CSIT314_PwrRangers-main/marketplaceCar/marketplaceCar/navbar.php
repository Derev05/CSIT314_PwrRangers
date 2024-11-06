<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<header class="logoheader">
		<a href="index.php" class="logo"><img src="assets/images/placeholderlogoDark.png"></a>		
		<nav class="navbar">		
		<?php		
			if(isset($_SESSION['username'])){
				echo '<a>'.htmlspecialchars($_SESSION['username']).'</a>';
				echo '<a href="logout.php">Log Out</a>';
			} else {
			echo '<a href="login.html">Login</a>';
			echo '<a href="index.php">Sign Up</a>';
			}
		?>
		</nav>
	</header>
</body>
</html>