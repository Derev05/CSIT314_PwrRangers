<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
	$('document').ready(function(){
		$('#navbar').load("navbar.php");
	});
	</script>
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
</head>
<body>
<div id="navbar"></div>
<div class="container mt-4">
  <div class="card-link">
    <div class="card">
      <div class="row g-0">
        <!-- Car Image -->
        <div class="col-md-2">
          <img src="assets/images/carListingimages/car_interior.png" class="img-fluid rounded-start h-100" alt="Car image" style="object-fit: cover;">
        </div>
        <!-- Car Details -->
        <div class="col-md-10">
          <div class="card-body">
            <!-- Title without underline -->
            <h3 class="card-title">
              <a href="someshit.php" class="text-decoration-none text-dark">Some Funny Car</a>
            </h3>
            <h4 class="price" id="price" class="text-decoration-none text-dark">$78,800</h4>
            <div class="row">
              <div class="col-6 col-md-4 car-info">
                <p class="text-decoration-none text-dark"><i class="bi bi-calendar3"></i> Registered: 24-May-2018</p>
                <p class="text-decoration-none text-dark"><i class="bi bi-person"></i> 2 Owners</p>
              </div>
            </div>
            <p class="mt-3 text-primary">Some description</p>
                        <!-- View and shortlist counters -->
            <div class="counters">
              <div class="text-decoration-none text-success" aria-label="Number of views"><i class="bi bi-eye"></i> <span id="noOfViews">0</span> views</div>
              <div class="text-decoration-none text-danger" aria-label="Number of shortlists"><i class="bi bi-heart"></i> <span id="noOfShortlists">0</span> shortlisted</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Bootstrap JS and Icons -->


</body>
</html>
