<?php
// Include the UserReview model
require_once '../entity/AgentReviews.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate POST data
    $data = [
        'reviewName' => isset($_POST['reviewName']) ? trim($_POST['reviewName']) : null,
        'agentName' => isset($_POST['agentName']) ? trim($_POST['agentName']) : null,
        'reviewRating' => isset($_POST['reviewRating']) ? (int)$_POST['reviewRating'] : null,
        'reviewDesc' => isset($_POST['reviewDesc']) ? trim($_POST['reviewDesc']) : null,
    ];

    // Check if all required fields are provided
    if ($data['reviewName'] && $data['agentName'] && $data['reviewRating'] && $data['reviewDesc']) {
        // Create the review using the UserReview model
        $result = AgentReviews::createReview($data);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Review created successfully.'
            ]);
            exit; // Ensure no further code is executed
        } else {
            error_log("Failed to create review in the database."); // Log error for debugging
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create review in the database.'
            ]);
            exit;
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Incomplete data. Please provide all required fields.'
        ]);
        exit;
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}
?>
