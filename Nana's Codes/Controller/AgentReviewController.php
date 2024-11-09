<?php
require_once '../entity/AgentReviews.php';

class AgentReviewController {
    public static function getReviewsByAgentName($agentName) {
        $reviews = UserReview::getReviewsByAgentName($agentName);
        header('Content-Type: application/json');

        if ($reviews) {
            // Calculate the average rating
            $totalRating = 0;
            $reviewCount = count($reviews);

            foreach ($reviews as $review) {
                $totalRating += $review['reviewRating'];
            }

            $averageRating = $reviewCount > 0 ? round($totalRating / $reviewCount, 1) : 0;

            echo json_encode([
                'success' => true,
                'data' => $reviews,
                'averageRating' => $averageRating
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No reviews found for this agent.'
            ]);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $agentName = isset($_GET['agentName']) ? $_GET['agentName'] : null;

    if ($agentName) {
        AgentReviewController::getReviewsByAgentName($agentName);
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Agent name is required.'
        ]);
    }
}
