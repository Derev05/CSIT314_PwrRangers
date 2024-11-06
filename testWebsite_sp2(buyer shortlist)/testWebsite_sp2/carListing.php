<?php
session_start();	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Listing Layout</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script>
	$('document').ready(function(){
		$('#navbar').load("navbar.php");
	});	
	</script>
  <style>
    .thumbnail {
      cursor: pointer;
      border: 2px solid transparent;
      max-height: 80px;
      margin-bottom: 10px;
    }
    .thumbnail.active {
      border-color: red;
    }
    .main-image {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
<div id="navbar"></div>
<div class="card text-center">
	<div class="card-body">
<?php
 if (isset($_SESSION['message'])) {
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>
	</div>
</div>
<div class="container mt-5">
  <!-- Header Section -->
  <div class="row">
    <div class="col-12 text-center">
      <h1 id="car_name"> Some funny car </h1>
    </div>
  </div>

  <div class="row mt-4">
    <!-- Left Column - Car Details -->
    <div class="col-lg-8">
      <!-- Price -->
      <h2 class="text-danger" id="price">$100,000</h2>
      
      <!-- Details Table -->
      <table class="table table-bordered">
        <tbody>         
          <tr>
			<td>Registration Date</td>
            <td id="regDate">24-May-2018</td>
            <td>No. of Owners</td>
            <td id="noOfOwners">4</td>
          </tr>
		  <tr>
			<td>Plate Number</td>
            <td colspan="3" id="plate_no">Placeholder</td>
		  </tr>
          <tr>
            <td>Type of Vehicle</td>
            <td colspan="3" id="vehType">Placeholder</td>
          </tr>
        </tbody>
      </table>
      <!-- Description -->
      <h5>Description</h5>
      <p id="description">Some description</p>
    </div>

    <!-- Right Column - Images and Chart -->
    <div class="col-lg-4">
      <!-- Main Image -->
      <img src="" alt="Main Car Image" class="main-image img-fluid mb-3">
	  
      <!-- Agent Information -->
      <div class="mt-4">
        <h5>Agent Information</h5>
		<table class="table table-bordered">
        <tbody>         
          <tr>
			<td>Name</td>
            <td id="agent_name">Agent</td>
            <td id="agent_contact">Contact No.</td>
            <td>11223344</td>
          </tr>
          <tr>
            <td id="agent_email">Email</td>
            <td colspan="3">anotheremail@email.com</td>
          </tr>
        </tbody>
      </table>
      </div>
	  
	  <!-- Seller Information -->
	  <div class="mt-4">
        <h5>Seller Information</h5> 
		<table class="table table-bordered">
        <tbody>         
          <tr>
			<td>Name</td>
            <td id="seller_name">Seller</td>
            <td id="seller_contact">Contact No.</td>
            <td>99887766</td>
          </tr>
          <tr>
            <td id="seller_email">Email</td>
            <td colspan="3">someemail@email.com</td>
          </tr>
        </tbody>
		</table>		
      </div>
	  	  
	  <!-- Shortlist for buyers -->	  
		  <form id="removeFromShortlist" action="UpdateShortlistController.php" method="POST">
			<input type="hidden" name="action" value="decrease">
			<input type="hidden" name="listingId" id="listingIdFieldRemove">
			<input type="hidden" name="username" id="username" value="<?php echo (isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '');?>">
			<button type="submit" class="btn btn-danger">Remove from Shortlist</button>
		  </form>
		  
		  <form id="addToShortlist" action="UpdateShortlistController.php" method="POST">
			<input type="hidden" name="action" value="increase">
			<input type="hidden" name="listingId" id="listingIdFieldAdd">
			<input type="hidden" name="username" id="username" value="<?php echo (isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '');?>">
			<button type="submit" class="btn btn-success">Shortlist</button>
		  </form>
    </div>
  </div>
</div>
<script>
	const urlParams = new URLSearchParams(window.location.search);
	const id = urlParams.get('id'); 	
	$('#listingIdFieldAdd').val(id);
	$('#listingIdFieldRemove').val(id);
	
	var username = <?php echo json_encode($_SESSION['username']); ?>;
</script>	
<script src="CarListingBoundary.js"></script>
</body>
</html>
