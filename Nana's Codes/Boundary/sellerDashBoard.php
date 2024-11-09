<?php
session_start();

function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    logout();
}

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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card {
            max-width: 250px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .card .card-img-top {
            height: 150px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }
    </style>

    <title>Seller Dashboard</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="py-2 bg-primary-subtle border-bottom">
        <div class="container d-flex flex-wrap justify-content-between">
            <ul class="nav me-auto">
                <li class="nav-item">
                    <a href="../boundary/index.php" class="nav-link">Home</a>
                </li>
            </ul>
            <div class="nav">
                <?php echo '<a class="nav-link link-dark px-2">' . htmlspecialchars($_SESSION['username']) . '</a>'; ?>
                <form action="navbar.php" method="POST">
                    <button type="submit" name="logout" class="nav-link link-dark px-2">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Car Listings Section -->
    <div class="container mt-4">
        <div class="mb-3 text-center">
            <h1>Your Car Listings</h1>
        </div>
        
        <input type="search" id="searchCarListing" class="form-control fs-5" placeholder="Search Car Listing" required>

        <h3>Tracked Car Listings for Shortlists and Views</h3>
        <div class="card-container" id="trackBothStatsCarListings"></div>

        <h3>Tracked Car Listings for Shortlists</h3>
        <div class="card-container" id="trackShortlistsCarListings"></div>

        <h3>Tracked Car Listings for Views</h3>
        <div class="card-container" id="trackViewsCarListings"></div>

        <h3>Untracked Car Listings</h3>
        <div class="card-container" id="untrackedCarListings"></div>
    </div>

    <script>
        var username = <?php echo json_encode($_SESSION['username']); ?>;
    </script>
    <script src="SellerBoundary.js"></script>
</body>
</html>
