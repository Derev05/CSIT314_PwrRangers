<?php
session_start();

function logout() {
	session_unset(); // Unset all session variables
	session_destroy(); // Destroy the session
	header("Location: index.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
	logout();
};

// Prevent caching to avoid "back" button issue after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
	
	<style>
        .price {
            color: red;
            font-weight: bold;
        }
        .price-monthly {
            color: #888;
            font-size: 0.9em;
        }
        .car-info p {
            margin-bottom: 5px;
            font-size: 0.9em;
        }
		 /* Styling for the counter box in the bottom-right corner */
        .counters {
            position: absolute;
            bottom: 10px;
            right: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 0.9em;
            color: #555;
        }
        .card {
            position: relative;
            cursor: pointer;
        }
    </style>

	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

	<!-- DataTables JS -->
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<title>Seller Dashboard</title>
</head>
<body>
	<!-- Navbar Code (Updated with image link for Home) -->
	<nav class="py-2 bg-primary-subtle border-bottom">
		<div class="container d-flex flex-wrap justify-content-between">
			<ul class="nav me-auto">
				<li class="nav-item">
					<a href="index.php" class="nav-link">Home</a>
				</li>
			</ul>
			<div class="nav">
			<?php		
				echo '<a class="nav-link link-dark px-2">'.$_SESSION['username'].'</a>';
			?>
				<form action="navbar.php" method="POST">
				<button type="submit" name="logout" class="nav-link link-dark px-2">
						Log Out
				</button>
				</form>
			</div>
		</div>
	</nav>

	<!-- Car Listing Search Section -->
	<div class="container mt-4">
		<div class="d-flex justify-content-between mb-3">
			<h4>Your Car Listings</h4>
		</div>
		<input type="search" id="searchCarListing" class="form-control" placeholder="Search Car Listing" name="query" required>
		<table class="table">
			<tbody id="listOfcarListings">
				<!-- Car listing data will be loaded here via JavaScript -->
			</tbody>
		</table>
	</div>
	<!-- JavaScript to handle form submission and BCE classes -->
	<script>
		var username = <?php echo json_encode($_SESSION['username']); ?>
	</script>
	<script src="SellerBoundary.js"></script>	
</body>
</html>
