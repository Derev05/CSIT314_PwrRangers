class AgentReviewBoundary {
    static async fetchReviewsByAgent(agentName) {
        try {
            const response = await fetch(`../controller/AgentReviewController.php?agentName=${encodeURIComponent(agentName)}`);
            const result = await response.json();

            if (result.success) {
                // Display the average rating
                AgentReviewBoundary.displayAverageRating(result.averageRating);
                
                // Display individual reviews
                AgentReviewBoundary.displayReviews(result.data);
            } else {
                console.error(result.message);
                AgentReviewBoundary.displayNoReviewsMessage();
            }
        } catch (error) {
            console.error("Fetch error:", error);
            AgentReviewBoundary.displayNoReviewsMessage();
        }
    }

    static displayAverageRating(averageRating) {
        const overallRatingContainer = document.querySelector('.overall-rating');
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
        reviewsContainer.innerHTML = '';

        reviews.forEach(review => {
            const reviewCard = document.createElement('div');
            reviewCard.classList.add('review-card');

            // Create and add reviewer photo
            const reviewerPhoto = document.createElement('img');
            reviewerPhoto.src = '../assets/images/cuteStar.png'; // Use default if photo is unavailable
            reviewerPhoto.alt = `${review.reviewName} Photo`;
            reviewerPhoto.classList.add('reviewer-photo');
            reviewCard.appendChild(reviewerPhoto);

            console.log("Reviewer photo URL:", reviewerPhoto.src);

            const username = document.createElement('strong');
            username.textContent = review.reviewName;
            reviewCard.appendChild(username);

            const starContainer = document.createElement('div');
            starContainer.classList.add('mt-1');
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('span');
                star.classList.add('star');
                star.textContent = i <= review.reviewRating ? '★' : '☆';
                starContainer.appendChild(star);
            }
            reviewCard.appendChild(starContainer);

            const comment = document.createElement('div');
            comment.classList.add('review-comment', 'mt-2');
            comment.textContent = review.reviewDesc;
            reviewCard.appendChild(comment);

            reviewsContainer.appendChild(reviewCard);
        });
    }

    static displayNoReviewsMessage() {
        const reviewsContainer = document.getElementById('reviewsContainer');
        reviewsContainer.innerHTML = '<p>No reviews found for this agent.</p>';
        AgentReviewBoundary.displayAverageRating(0); // Display 0 rating if no reviews found
    }
}

// Fetch reviews when the page loads, using the agent name from URL parameters
document.addEventListener("DOMContentLoaded", () => {
    const agentName = new URLSearchParams(window.location.search).get('name');
    if (agentName) {
        AgentReviewBoundary.fetchReviewsByAgent(agentName);
    } else {
        console.error("No agent name provided in the URL.");
        AgentReviewBoundary.displayNoReviewsMessage();
    }
});
