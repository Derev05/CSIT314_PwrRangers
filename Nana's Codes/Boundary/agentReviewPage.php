<?php
  session_start();


$agentName = isset($_GET['name']) ? $_GET['name'] : 'N/A';
$agentContact = isset($_GET['contact']) ? $_GET['contact'] : 'N/A';
$agentEmail = isset($_GET['email']) ? $_GET['email'] : 'N/A';
$overallRating = 4.7;

// Assuming the user's name is stored in the session under 'username'
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agent Review - Marketplace.car</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      margin-top: 0;
      padding-top: 10px;
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
      position: relative;
    }
    .review-card strong {
      font-size: 18px;
      color: #333;
    }
    .review-comment {
      margin-top: 10px;
      color: #333;
    }

    /* Agent profile picture - large size */
    .profile-photo-large {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-right: 20px;
      object-fit: cover;
    }

    /* Reviewer profile picture - smaller size */
    .reviewer-photo {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
      object-fit: cover;
      vertical-align: middle;
    }

        /* Existing styles */
        .review-card {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 8px;
        position: relative;
    }
    /* Styles for buttons in the top-right corner */
    .review-card .action-buttons {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .review-card .action-buttons button {
        margin-left: 5px;
    }
</style>

<body>
<div id="navbar"></div>
<div id="navbar">
    <?php include 'navbar.php'; ?>
</div>
<?php
 if (isset($_SESSION['message'])) {
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>

<div class="container">
  <h1>Agent Info</h1>
  <!-- Agent Information -->
  <div class="agent-info-box d-flex">
    <img src="../assets/images/9203764.png" alt="Agent Photo" class="profile-photo-large"> 
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

  <!-- "Leave a Review" Button -->
  <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#reviewModal">Leave a Review</button>

  <!-- Reviews Section -->
  <div id="reviewsContainer" class="mt-4">
    <!-- Reviews will be loaded here by AgentReviewBoundary.js -->
  </div>
</div>

<!-- Review Modal for Creating a New Review -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="reviewForm" action="javascript:void(0);">
        <div class="modal-body">
          <input type="hidden" name="agent_name" value="<?php echo htmlspecialchars($agentName); ?>">
          <input type="hidden" name="reviewName" value="<?php echo htmlspecialchars($userName); ?>">

          <div class="form-group">
            <label><strong>Your Username:</strong> <?php echo htmlspecialchars($userName); ?></label>
          </div>

          <div class="form-group mt-3">
            <label for="reviewRating">Your Rating</label>
            <select id="reviewRating" name="reviewRating" class="form-control" required>
              <option value="5">5 - Excellent</option>
              <option value="4">4 - Good</option>
              <option value="3">3 - Average</option>
              <option value="2">2 - Poor</option>
              <option value="1">1 - Terrible</option>
            </select>
          </div>
          <div class="form-group mt-3">
            <label for="reviewDesc">Your Comment</label>
            <textarea id="reviewDesc" name="reviewDesc" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit Review</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Review Modal for Editing an Existing Review -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editReviewModalLabel">Edit Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editReviewForm" action="javascript:void(0);">
        <div class="modal-body">

          <input type="hidden" id="editReviewId">
          <input type="hidden" name="agent_name" value="<?php echo htmlspecialchars($agentName); ?>"> <!-- Hidden agent name -->
          <div class="form-group mt-3">
            <label for="editReviewRating">Your Rating</label>
            <select id="editReviewRating" name="editReviewRating" class="form-control" required>
              <option value="5">5 - Excellent</option>
              <option value="4">4 - Good</option>
              <option value="3">3 - Average</option>
              <option value="2">2 - Poor</option>
              <option value="1">1 - Terrible</option>
            </select>
          </div>
          <div class="form-group mt-3">
            <label for="editReviewDesc">Your Comment</label>
            <textarea id="editReviewDesc" name="editReviewDesc" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript Files -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
  // Store the logged-in user's username in a hidden input for JavaScript access
  document.body.innerHTML += `<input type="hidden" id="currentUsername" value="<?php echo htmlspecialchars($userName); ?>">`;
</script>

<script src="AgentReviewBoundary.js" defer></script>
<script src="CreateReviewOnAgentBoundary.js" defer></script>
</body>
</html>
