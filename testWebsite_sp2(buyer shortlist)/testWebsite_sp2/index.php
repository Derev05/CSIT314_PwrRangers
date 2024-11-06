<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script>
	$('document').ready(function(){
		$('#navbar').load("navbar.php");
	});
	</script>
</head>
<body>
	<div id="navbar"></div>
	<?php if(isset($_SESSION['username'])): ?>
	<div class="row">
		<div class="col-12 text-center">
			<h1 id="car_name"> Welcome to Marketplace.car </h1>
		</div>
	</div>
	
	
	<div class="container mt-4">
		<div class="d-flex justify-content-between mb-3">
			<h4>All Car Listings</h4>
		</div>
		<table class="table">
			<tbody id="listOfcarListings">
				<!-- Car listing data will be loaded here via JavaScript -->
			</tbody>
		</table>
	</div>
	<script src="ViewAllListings.js"></script>
	<?php endif; ?>
</body>
</html>