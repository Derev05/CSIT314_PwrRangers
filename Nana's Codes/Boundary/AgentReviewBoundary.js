class AgentReviewBoundary {
    static async fetchReviewsByAgent(agentName) {
        try {
            const response = await fetch(`../controller/AgentReviewController.php?agentName=${encodeURIComponent(agentName)}`);
            const result = await response.json();

            if (result.success && result.data && result.data.length > 0) {
                AgentReviewBoundary.displayAverageRating(result.averageRating);
                AgentReviewBoundary.displayReviews(result.data);
            } else {
                console.error(result.message || "No reviews found.");
                AgentReviewBoundary.displayNoReviewsMessage();
            }
        } catch (error) {
            console.error("Fetch error:", error);
            AgentReviewBoundary.displayNoReviewsMessage();
        }
    }

    static displayAverageRating(averageRating) {
        const overallRatingContainer = document.querySelector('.overall-rating');
        if (!overallRatingContainer) return;

        overallRatingContainer.innerHTML = `
            <span class="rating-value">${averageRating}</span> out of 5
            <div class="ml-3">
                ${Array.from({ length: 5 }, (_, i) => 
                    `<span class="star">${i < Math.round(averageRating) ? '★' : '☆'}</span>`
                ).join('')}
            </div>
        `;
    }

    static displayReviews(reviews) {
        const reviewsContainer = document.getElementById('reviewsContainer');
        if (!reviewsContainer) return;
        reviewsContainer.innerHTML = '';

        // Separate the current user's reviews from other reviews
        const currentUsername = document.getElementById("currentUsername")?.value;
        const userReviews = [];
        const otherReviews = [];

        reviews.forEach(review => {
            if (review.reviewName === currentUsername) {
                userReviews.push(review);
            } else {
                otherReviews.push(review);
            }
        });

        // Display the current user's reviews first
        userReviews.forEach(review => {
            const reviewCard = AgentReviewBoundary.createReviewCard(review, true);
            reviewsContainer.appendChild(reviewCard);
        });

        // Display other users' reviews
        otherReviews.forEach(review => {
            const reviewCard = AgentReviewBoundary.createReviewCard(review, false);
            reviewsContainer.appendChild(reviewCard);
        });
    }

    static createReviewCard(review, isUserReview) {
        const reviewCard = document.createElement('div');
        reviewCard.classList.add('review-card');
    
        // Profile photo
        const reviewerPhoto = document.createElement('img');
        reviewerPhoto.src = '../assets/images/cuteStar.png';
        reviewerPhoto.alt = `${review.reviewName} Photo`;
        reviewerPhoto.classList.add('reviewer-photo');
        reviewCard.appendChild(reviewerPhoto);
    
        // Username
        const username = document.createElement('strong');
        username.textContent = review.reviewName;
        reviewCard.appendChild(username);
    
        // Star rating
        const starContainer = document.createElement('div');
        starContainer.classList.add('mt-1');
        for (let i = 1; i <= 5; i++) {
            const star = document.createElement('span');
            star.classList.add('star');
            star.textContent = i <= review.reviewRating ? '★' : '☆';
            starContainer.appendChild(star);
        }
        reviewCard.appendChild(starContainer);
    
        // Comment text
        const comment = document.createElement('div');
        comment.classList.add('review-comment', 'mt-2');
        comment.textContent = review.reviewDesc;
        reviewCard.appendChild(comment);
    
        // Action buttons (Edit and Delete) for the current user's reviews
        if (isUserReview) {
            const actionButtons = document.createElement('div');
            actionButtons.classList.add('action-buttons');
    
            const editButton = document.createElement('button');
            editButton.classList.add('btn', 'btn-warning', 'btn-sm');
            editButton.textContent = 'Edit';
            editButton.onclick = () => AgentReviewBoundary.openEditModal(review);
            actionButtons.appendChild(editButton);
    
            const deleteButton = document.createElement('button');
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
            deleteButton.textContent = 'Delete';
            deleteButton.onclick = () => AgentReviewBoundary.confirmAndDeleteReview(review.id);
            actionButtons.appendChild(deleteButton);
    
            // Add action buttons to the review card
            reviewCard.appendChild(actionButtons);
        }
    
        return reviewCard;
    }
    

    static openEditModal(review) {
        // Open the edit modal with existing review data
        $('#editReviewModal').modal('show'); // Show the modal
        document.getElementById("editReviewId").value = review.id;
        document.getElementById("editReviewRating").value = review.reviewRating;
        document.getElementById("editReviewDesc").value = review.reviewDesc;

        document.getElementById("editReviewForm").onsubmit = (event) => {
            event.preventDefault();
            AgentReviewBoundary.submitEditReview(review.id);
        };
    }

    static async submitEditReview(reviewId) {
        const updatedReviewData = {
            reviewId: reviewId,
            agentName: document.querySelector("input[name='agent_name']").value, // Ensure this input exists in the form
            reviewRating: document.getElementById("editReviewRating").value,
            reviewDesc: document.getElementById("editReviewDesc").value,
            action: 'edit'
        };
    
        try {
            const response = await fetch('../controller/EditReviewOnAgentController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(updatedReviewData).toString()
            });
    
            const result = await response.json();
            if (result.success) {
                alert("Review updated successfully.");
                location.reload(); // Reload page to display the updated review
            } else {
                alert(result.message || "Error updating review.");
            }
        } catch (error) {
            console.error("Error submitting edit review:", error);
            alert("Failed to submit the review edit. Please try again.");
        }
    }
    
    

    static async confirmAndDeleteReview(reviewId) {
        if (confirm("Are you sure you want to delete this review?")) {
            try {
                const response = await fetch('../controller/DeleteReviewOnAgentController.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ reviewId, action: 'delete' }).toString()
                });
    
                const result = await response.json();
                if (result.success) {
                    alert("Review deleted successfully.");
                    location.reload(); // Reload page to reflect the deleted review
                } else {
                    alert(result.message || "Error deleting review.");
                }
            } catch (error) {
                console.error("Error deleting review:", error);
                alert("Failed to delete the review. Please try again.");
            }
        }
    }
    

    static displayNoReviewsMessage() {
        const reviewsContainer = document.getElementById('reviewsContainer');
        if (!reviewsContainer) return;
        reviewsContainer.innerHTML = '<p>No reviews found for this agent.</p>';
        AgentReviewBoundary.displayAverageRating(0);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const agentName = new URLSearchParams(window.location.search).get('name');
    if (agentName) {
        AgentReviewBoundary.fetchReviewsByAgent(agentName);
    }
});
