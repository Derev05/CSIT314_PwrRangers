document.addEventListener('DOMContentLoaded', () => {
    new SellerBoundary();
});

class SellerBoundary {
    constructor() {
        this.init();
    }

    init() {
        this.loadTrackedListingsBoth();
        this.loadTrackedListingsShortlists();
        this.loadTrackedListingsViews();
        this.loadUntrackedCarListings();
        this.setupEventListeners();
    }

	createCard(item, trackViews = false, trackShortlists = false) {
        return `
            <div class="card mb-3" style="max-width: 250px;">
                <!-- Car Image at the Top -->
                <div class="card-img-top bg-light" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                    <img src="${item.imagePath || 'placeholder-image.png'}" alt="${item.car_name}" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                </div>

                <!-- Car Details -->
                <div class="card-body p-2">
                    <h6 class="card-title mb-1">${item.car_name}</h6>
                    <p class="price mb-1 text-danger" style="font-weight: bold;">$${item.price}</p>
                    <p class="mb-1"><i class="bi bi-calendar3"></i> ${item.regDate}</p>
                    <p class="mb-1"><i class="bi bi-person"></i> ${item.noOfOwners} Owners</p>
                    <p class="mb-1"><i class="bi bi-car-front-fill"></i> ${item.vehType}</p>

					<br/>
					
                    <!-- Views and Shortlists Count -->
                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <p class="text-success mb-0"><i class="bi bi-eye"></i> ${item.noOfViews} views</p>
                        <p class="text-danger mb-0"><i class="bi bi-heart"></i> ${item.noOfShortlists} shortlisted</p>
                    </div>
                </div>

                <!-- Card Footer with Track Buttons -->
                <div class="card-footer d-flex gap-2">
                    <form action="../controller/TrackViewsController.php" method="GET" class="flex-grow-1">
                        <input type="hidden" name="action" value="${trackViews ? 'untrack' : 'track'}">
                        <input type="hidden" name="viewsListingId" value="${item.id}">
                        <button type="submit" class="btn ${trackViews ? 'btn-outline-danger' : 'btn-outline-primary'} btn-sm w-100">
                            ${trackViews ? 'Untrack views' : 'Track views'}
                        </button>
                    </form>

                    <form action="../controller/TrackShortlistsController.php" method="GET" class="flex-grow-1">
                        <input type="hidden" name="action" value="${trackShortlists ? 'untrack' : 'track'}">
                        <input type="hidden" name="shortListingId" value="${item.id}">
                        <button type="submit" class="btn ${trackShortlists ? 'btn-outline-danger' : 'btn-outline-primary'} btn-sm w-100">
                            ${trackShortlists ? 'Untrack shortlist' : 'Track shortlist'}
                        </button>
                    </form>
                </div>
            </div>
        `;
    }

    loadTrackedListingsBoth(query = '') {
        fetch(`../controller/TrackBothStatsCarListingFetchController.php?query=${query}&username=${username}`)
            .then(response => response.json())
            .then(data => {
                const cardContainer = document.getElementById('trackBothStatsCarListings');
                cardContainer.innerHTML = '';
                data.forEach(item => {
                    cardContainer.innerHTML += this.createCard(item, true, true);
                });
            })
            .catch(error => console.error('Error fetching tracked listings for both:', error));
    }

    loadTrackedListingsShortlists(query = '') {
        fetch(`../controller/TrackShortlistsCarListingFetchController.php?query=${query}&username=${username}`)
            .then(response => response.json())
            .then(data => {
                const cardContainer = document.getElementById('trackShortlistsCarListings');
                cardContainer.innerHTML = '';
                data.forEach(item => {
                    cardContainer.innerHTML += this.createCard(item, false, true);
                });
            })
            .catch(error => console.error('Error fetching tracked shortlists:', error));
    }

    loadTrackedListingsViews(query = '') {
        fetch(`../controller/TrackViewsCarListingFetchController.php?query=${query}&username=${username}`)
            .then(response => response.json())
            .then(data => {
                const cardContainer = document.getElementById('trackViewsCarListings');
                cardContainer.innerHTML = '';
                data.forEach(item => {
                    cardContainer.innerHTML += this.createCard(item, true, false);
                });
            })
            .catch(error => console.error('Error fetching tracked views:', error));
    }

    loadUntrackedCarListings(query = '') {
        fetch(`../controller/UntrackedCarListingsFetchController.php?query=${query}&username=${username}`)
            .then(response => response.json())
            .then(data => {
                const cardContainer = document.getElementById('untrackedCarListings');
                cardContainer.innerHTML = '';
                data.forEach(item => {
                    cardContainer.innerHTML += this.createCard(item, false, false);
                });
            })
            .catch(error => console.error('Error fetching untracked listings:', error));
    }

    setupEventListeners() {
        const searchInput = document.getElementById('searchCarListing');
        if (searchInput) {
            searchInput.addEventListener('input', (event) => {
                const query = event.target.value;
                this.loadTrackedListingsBoth(query);
                this.loadTrackedListingsShortlists(query);
                this.loadTrackedListingsViews(query);
                this.loadUntrackedCarListings(query);
            });
        }
    }
}
