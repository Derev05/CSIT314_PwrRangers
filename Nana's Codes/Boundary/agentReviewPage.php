<?php
session_start();

$agentName = isset($_GET['name']) ? $_GET['name'] : 'N/A';
$agentContact = isset($_GET['contact']) ? $_GET['contact'] : 'N/A';
$agentEmail = isset($_GET['email']) ? $_GET['email'] : 'N/A';
$overallRating = 4.7;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agent Review - Marketplace.car</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script>
  $(document).ready(function() {
      $('#navbar').load("navbar.php");
  });
</script>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
    margin-top: 0; /* Ensures container starts directly below the navbar */
    padding-top: 10px; /* Adjust as needed */
}
.agent-info-box {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
}
    .overall-rating {
      display: flex;
      align-items: center;
      font-size: 24px;
      color: #e74c3c;
      margin-bottom: 20px;
    }
    .rating-value {
      color: #ff9900;
      margin-right: 10px;
    }
    .star {
      color: gold;
      font-size: 20px;
    }
    .review-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 20px;
      background-color: #fff;
      border-radius: 8px;
    }
    .review-card strong {
      font-size: 18px;
      color: #333;
    }
    .review-comment {
      margin-top: 10px;
      color: #333;
    }

    .profile-photo-large {
    width: 100px; /* Larger size for better visibility */
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.reviewer-photo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    display: inline-block;
    vertical-align: middle;
}

  </style>
</head>
<body>

<div id="navbar"></div>



  <div class="container">
  <h1>Agent Info</h1>
    <!-- Agent Information -->
    <div class="agent-info-box d-flex">
    <!-- Agent Profile Picture -->
    <img src="../assets/images/9203764.png" alt="Agent Photo" class="profile-photo-large"> 
    <!-- Agent Details -->
    <div class="agent-details">
      
      <p><strong>Name:</strong> <?php echo htmlspecialchars($agentName); ?></p>
      <p><strong>Contact:</strong> <?php echo htmlspecialchars($agentContact); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($agentEmail); ?></p>
    </div>
  </div>


  <!-- Overall Rating -->
  <div class="overall-rating">
    <span class="rating-value"><?php echo $overallRating; ?></span> out of 5
    <div class="ml-3">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <span class="star"><?php echo $i <= round($overallRating) ? '★' : '☆'; ?></span>
      <?php endfor; ?>
    </div>
  </div>

  <!-- Reviews Section -->
  <div id="reviewsContainer" class="mt-4">
    <!-- Reviews will be loaded here by AgentReviewBoundary.js -->
  </div>
</div>

</body>
<!-- Include the boundary script -->
<script src="AgentReviewBoundary.js" defer></script>
</html>
