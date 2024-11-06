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

	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

	<!-- DataTables JS -->
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<title>Admin Panel</title>
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

	<!-- User Search and Add Button Section -->
	<div class="container mt-4">
		<div class="d-flex justify-content-between mb-3">
			<h4>Search for User</h4>
			<button class="btn btn-success" id="addUserBtn" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">+ Add User</button>
		</div>
		<input type="search" id="searchUser" class="form-control" placeholder="Search User" name="query" required>

		<!-- User List Table -->
		<table class="table table-striped" id="userTable">
			<thead class="table-primary">
				<tr>
					<th scope="col">Username</th>
					<th scope="col">Password</th>
					<th scope="col">Email Address</th>
					<th scope="col">Contact Number</th>
					<th scope="col">Date Of Birth</th>
					<th scope="col">Role</th>
					<th scope="col">Account Created</th>
					<th scope="col">Status</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody id="userTableBody">
				<!-- User data will be loaded here via JavaScript -->
			</tbody>
		</table>
	</div>

	<!-- Add/Edit User Modal -->
	<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addEmployeeModalLabel">Add Info</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="addUserForm" method="POST">
						<input type="hidden" id="userId" name="userId"> <!-- For storing user ID when editing -->
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" required minlength="4">
							<div class="invalid-feedback">Username must be at least 4 characters long.</div>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="text" class="form-control" id="password" name="password" required>
							<div class="invalid-feedback">Please provide a password.</div>
						</div>
						<div class="mb-3">
							<label for="contactno" class="form-label">Contact Number</label>
							<input type="text" class="form-control" id="contactno" name="contactno" required>
							<div class="invalid-feedback">Please provide a contact number.</div>
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email Address</label>
							<input type="email" class="form-control" id="email" name="email" required>
							<div class="invalid-feedback">Please provide a valid email address.</div>
						</div>
						<div class="mb-3">
							<label for="dob" class="form-label">Date of Birth</label>
							<input type="date" class="form-control" id="dob" name="dob" required>
							<div class="invalid-feedback">Please provide a valid date of birth.</div>
						</div>
						<div class="mb-3">
							<label for="role" class="form-label">Roles</label>
							<select class="form-select" id="role" name="role" required>
								<option selected disabled>Select</option>
								<option value="Agent">Agent</option>
								<option value="Buyer">Buyer</option>
								<option value="Seller">Seller</option>
							</select>
							<div class="invalid-feedback" id="roleFeedback">Please select a role.</div>
						</div>
						<button type="submit" class="btn btn-primary" id="saveUserBtn">Save User</button>
						<div class="mb-3">
							<label for="isSuspended" class="form-label">Suspend Account</label>
							<input type="checkbox" id="isSuspended" name="isSuspended">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- JavaScript to handle form submission and BCE classes -->
	<script src="UserBoundary.js"></script>	
</body>
</html>
