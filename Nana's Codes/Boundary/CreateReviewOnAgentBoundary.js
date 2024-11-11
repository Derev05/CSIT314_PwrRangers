class CreateReviewOnAgentBoundary {
    static async submitReview(reviewData) {
        try {
            const response = await fetch('../controller/CreateReviewOnAgentController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(reviewData).toString()
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();

            if (result.success) {
                alert("Review submitted successfully!");

                // Reload the page after successful submission
                location.reload();
            } else {
                alert(result.message || "An error occurred while submitting your review.");
            }
        } catch (error) {
            console.error("Error submitting review:", error);
            alert("Failed to submit review. Please try again later.");
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const reviewForm = document.getElementById("reviewForm");

    if (reviewForm) {
        reviewForm.addEventListener("submit", async function(event) {
            event.preventDefault(); // Prevents default form submission behavior

            if (reviewForm.dataset.submitting === "true") return;
            reviewForm.dataset.submitting = "true";

            const submitButton = reviewForm.querySelector("button[type='submit']");
            if (submitButton) submitButton.disabled = true;

            const reviewData = {
                reviewName: document.querySelector("input[name='reviewName']").value,
                agentName: document.querySelector("input[name='agent_name']").value,
                reviewRating: document.querySelector("select[name='reviewRating']").value,
                reviewDesc: document.querySelector("textarea[name='reviewDesc']").value,
            };

            await CreateReviewOnAgentBoundary.submitReview(reviewData);

            reviewForm.dataset.submitting = "false";
            if (submitButton) submitButton.disabled = false;
        });
    }
});
